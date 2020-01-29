//all the loraWAN code is the deafault theThingsNetworkCode: https://github.com/TheThingsNetwork/arduino-device-lib

boolean fake = false;

#include <TheThingsNetwork.h>
#include <TinyGPS.h>
#include <SoftwareSerial.h>
#define debugSerial Serial

//the things part
// Set your AppEUI and AppKey
const char *appEui = "70B3D57ED0022E0E";
const char *appKey = "409945AA983522B340F08BAEAD0C1529";

#define loraSerial Serial1

// Replace REPLACE_ME with TTN_FP_EU868 or TTN_FP_US915
#define freqPlan TTN_FP_EU868

TheThingsNetwork ttn(loraSerial, debugSerial, freqPlan);

//the typedef code comes from: https://github.com/brady-aiello/Seeeduino_LoRaWAN_for_hybrid_gateways/blob/master/Seeeduino-LoRaWAN-GPS-app/Seeeduino-LoRaWAN-GPS-app.ino
typedef union {
  float f[2];               // Assigning fVal.f will also populate fVal.bytes;
  unsigned char bytes[8];   // Both fVal.f and fVal.bytes share the same 4 bytes of memory.
} floatArr2Val;
floatArr2Val payload;

//the gps part

// define variables for pins
int gpsBoardTX = 6;
int gpsBoardRX = 7;

SoftwareSerial mySerial(gpsBoardTX, gpsBoardRX); // RX, TX
TinyGPS gps;

void setup()
{
  pinMode(2, INPUT);

  loraSerial.begin(57600);
  debugSerial.begin(9600);
  mySerial.begin(9600);

  // Wait a maximum of 10s for Serial Monitor
  while (!debugSerial && millis() < 10000)
    ;


}

void loop()
{
  debugSerial.println("-- LOOP");

  if (fake) {
    double xCoord = 56.234464;
    double yCoord = 23.345908;
  } else {
    
    bool newdata = false;
    unsigned long start = millis();
    // Every 5 seconds we print an update
    while (millis() - start < 5000)
    {
      if (mySerial.available())
      {
        char c = mySerial.read();
        //debugSerial.print(c);  // uncomment to see raw GPS data
        if (gps.encode(c))
        {
          newdata = true;
          break;  // uncomment to print new data immediately!
        }
      }
    }

    if (newdata)
    {
      debugSerial.println("Acquired Data");
      debugSerial.println("-------------");
      gpsdump(gps);
      debugSerial.println("-------------");
      debugSerial.println();
    }

  }
/*
  if (digitalRead(2) == HIGH) {
    payload.f[0] = xCoord; //n to s
    payload.f[1] = yCoord; //w to o
    ttn.sendBytes(payload.bytes, sizeof(payload));
    delay(10000);
  }*/
}

void gpsdump(TinyGPS &gps){
  long lat, lon;
  float flat, flon;
  unsigned long age, date, time, chars;
  int year;
  byte month, day, hour, minute, second, hundredths;
  unsigned short sentences, failed;

  gps.get_position(&lat, &lon, &age);
  Serial.print("Lat/Long(10^-5 deg): "); Serial.print(lat); Serial.print(", "); Serial.print(lon); 
  Serial.print(" Fix age: "); Serial.print(age); Serial.println("ms.");
  
  // On Arduino, GPS characters may be lost during lengthy Serial.print()
  // On Teensy, Serial prints to USB, which has large output buffering and
  //   runs very fast, so it's not necessary to worry about missing 4800
  //   baud GPS characters.

  gps.f_get_position(&flat, &flon, &age);
  Serial.print("Lat/Long(float): "); printFloat(flat, 5); Serial.print(", "); printFloat(flon, 5);
    Serial.print(" Fix age: "); Serial.print(age); Serial.println("ms.");

  gps.get_datetime(&date, &time, &age);
  Serial.print("Date(ddmmyy): "); Serial.print(date); Serial.print(" Time(hhmmsscc): ");
    Serial.print(time);
  Serial.print(" Fix age: "); Serial.print(age); Serial.println("ms.");

  gps.crack_datetime(&year, &month, &day, &hour, &minute, &second, &hundredths, &age);
  Serial.print("Date: "); Serial.print(static_cast<int>(month)); Serial.print("/"); 
    Serial.print(static_cast<int>(day)); Serial.print("/"); Serial.print(year);
  Serial.print("  Time: "); Serial.print(static_cast<int>(hour+8));  Serial.print(":"); //Serial.print("UTC +08:00 Malaysia");
    Serial.print(static_cast<int>(minute)); Serial.print(":"); Serial.print(static_cast<int>(second));
    Serial.print("."); Serial.print(static_cast<int>(hundredths)); Serial.print(" UTC +08:00 Malaysia");
  Serial.print("  Fix age: ");  Serial.print(age); Serial.println("ms.");

 
  gps.stats(&chars, &sentences, &failed);
  Serial.print("Stats: characters: "); Serial.print(chars); Serial.print(" sentences: ");
    Serial.print(sentences); Serial.print(" failed checksum: "); Serial.println(failed);
}

void printFloat(double number, int digits){
  // Handle negative numbers
  if (number < 0.0) 
  {
     Serial.print('-');
     number = -number;
  }

  // Round correctly so that print(1.999, 2) prints as "2.00"
  double rounding = 0.5;
  for (uint8_t i=0; i<digits; ++i)
    rounding /= 10.0;
  
  number += rounding;

  // Extract the integer part of the number and print it
  unsigned long int_part = (unsigned long)number;
  double remainder = number - (double)int_part;
  Serial.print(int_part);

  // Print the decimal point, but only if there are digits beyond
  if (digits > 0)
    Serial.print("."); 

  // Extract digits from the remainder one at a time
  while (digits-- > 0) 
  {
    remainder *= 10.0;
    int toPrint = int(remainder);
    Serial.print(toPrint);
    remainder -= toPrint;
  }
}
