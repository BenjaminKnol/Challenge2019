


// Tijdelijk niet gebruiken!!

// Graag eerst een van de test Sketches werkend krijgen, daarna hierin implementeren of de functies uit deze sketch implementeren in een nieuwe





















// Get GPS location
// Made by A.M. Heijboer on 19-11-2019
// Version 0.0.8
// Last edited on 04-12-2019

// STILL NEEDS WORK!! TESTING!

#include <SoftwareSerial.h>
#include <TinyGPS.h>

// set Arduino type
String arduinoTypeString = "Uno";     // enter the Arduino that is used. Options are: Uno / Mega
int arduinoTypeInt = 0;               // string cannot be used, so we use a integer for the Arduino selection. This variable is filled later

// create variables for board pins
int gpsBoardTX; 
int gpsBoardRX;
int gpsBoardGround;
int gpsBoardVCC;
// create booleans
boolean setup01b = true;                  // execute setup01b?
boolean debugTestSerialEnabled = true;    // enable debug output over serial?

TinyGPS gps;

void gpsdump(TinyGPS &gps);
void printFloat(double f, int digits = 2);

void setup(){
  // check Arduino type from arduinoTypeString, cast to integer and write to arduinoTypeInt
  if(arduinoTypeString.equals("Uno")){arduinoTypeInt = 1;};
  if(arduinoTypeString.equals("Mega")){arduinoTypeInt = 2;};

  // set variables for pins on Arduino, based on Arduino type (in integer) from arduinoTypeInt
  switch(arduinoTypeInt){
    case 1:
      gpsBoardTX = 4;
      gpsBoardRX = 5;
      gpsBoardGround = 6;
      gpsBoardVCC = 7;
      break;
    case 2:
      gpsBoardTX = 3;
      gpsBoardRX = 4;
      gpsBoardGround = 5;
      gpsBoardVCC = 6;
      break;
    default:
      break;
  }

  // provide power for GPS module | set pinMode and digitalWrite for VCC en Ground pins on the Arduino, connected to the GPS module
  pinMode(gpsBoardVCC, OUTPUT);      // sets gpsBoardVCC PIN as output
  digitalWrite(gpsBoardVCC, HIGH);   // connect gpsBoardVCC to 5V
  pinMode(gpsBoardGround, OUTPUT);   // sets gpsBoardGround PIN as output
  digitalWrite(gpsBoardGround, LOW); // connect gpsBoardGround to ground

  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while(!Serial && millis() < 1000){;} // wait for serial port to connect. Needed for native USB only. Maximum waiting time is 1 second 
  Serial.println("Haal die locatie op!!\n");
  debugTestSerial("SETUP","OK",0);                                  // DEBUG TEST | PRINT LINE TO SERIAL  | SETUP | OK
}

// Open and define Software Serial
SoftwareSerial gpsSerial(gpsBoardTX, gpsBoardRX); // RX, TX

// Sjabloon debug regel
// debugTestSerial("","",0);      // DEBUG TEST | PRINT LINE TO SERIAL  | FillFUNCTION  | FillMESSAGE

void loop(){
  if(setup01b){setup01();}               // run setup01 to open Software Serial connection
  debugTestSerial("MAIN","OK",1);                                  // DEBUG TEST | PRINT LINE TO SERIAL | MAIN  | OK // parameter 1 to show Arduino runtime
  
  bool newdata = false;
  unsigned long start = millis();
  // every 5 seconds we print an update
  while (millis() - start < 5000) 
  {
    if (gpsSerial.available())
    {
      debugTestSerial("IF gpsSerial.availible","OK",0);                                  // DEBUG TEST | PRINT LINE TO SERIAL  | FillFUNCTION  | FillMESSAGE
      char c = gpsSerial.read();
      
      //Serial.println(gps.encode(c));
      //gps.encode(c);
      
      Serial.print(c);  // uncomment to see raw GPS data
      if (gps.encode(c)) // passes 1 character to gps.encode()
      {
        debugTestSerial("if gps.encode(c)","OK",0);                                  // DEBUG TEST | PRINT LINE TO SERIAL | if gps.encode(c)  | OK
        newdata = true;
        break;  // uncomment to print new data immediately!
      }
    }
  }
  
  if (newdata) 
  {
    debugTestSerial("if newdata","OK",0);                                  // DEBUG TEST | PRINT LINE TO SERIAL | if newdate  | OK
    Serial.println("Acquired Data");
    Serial.println("-------------");
    gpsdump(gps);
    Serial.println("-------------");
    Serial.println();
  }
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

  Serial.print("Alt(cm): "); Serial.print(gps.altitude()); Serial.print(" Course(10^-2 deg): ");
    Serial.print(gps.course()); Serial.print(" Speed(10^-2 knots): "); Serial.println(gps.speed());
  Serial.print("Alt(float): "); printFloat(gps.f_altitude()); Serial.print(" Course(float): ");
    printFloat(gps.f_course()); Serial.println();
  Serial.print("Speed(knots): "); printFloat(gps.f_speed_knots()); Serial.print(" (mph): ");
    printFloat(gps.f_speed_mph());
  Serial.print(" (mps): "); printFloat(gps.f_speed_mps()); Serial.print(" (kmph): ");
    printFloat(gps.f_speed_kmph()); Serial.println();

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

void debugTestSerial(String codePart, String message, int showRuntime){
  if(debugTestSerialEnabled){
    switch(showRuntime){
      case 0:
        Serial.println("debugTestSerial: " + codePart + ": " + message);
        break;
      case 1:
        Serial.print("debugTestSerial: " + codePart + ": " + message);
        Serial.println(" - Runtime Arduino in seconds: "+String(millis()/1000, DEC));
        break;
      case 2:
        Serial.println("Runtime Arduino in seconds: "+String(millis()/1000, DEC));
        break;
      default:
        Serial.print("ERROR while starting debugTestSerial function: invalid parameter passed for int showRuntime: ");
        Serial.println(showRuntime);
        break;
    }
  }
}

static void setup01(){
  // set the data rate for the SoftwareSerial port
  gpsSerial.begin(9600);
  delay(1000);
  setup01b = false;
}
