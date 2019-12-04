/* Script gedownload vanaf https://idyl.io/arduino/how-to/interface-gps-module-arduino/
   Alleen alles wat tussen // ############################################### en // ############################################### staat heb ik zelf aangepast, de rest is origineel
*/


// ###############################################

// create variables for board pins
int gpsBoardTX = 4;
int gpsBoardRX = 5;
int gpsBoardGround = 6;
int gpsBoardVCC = 7;

// ###############################################

#include <SoftwareSerial.h>

static const int RXPin = gpsBoardTX, TXPin = gpsBoardRX;  // ZELF TX EN RX VARIABLES TOEGEVOEGD
static const uint32_t GPSBaud = 9600;

// The serial connection to the GPS device
SoftwareSerial ss(RXPin, TXPin);

void setup()
{
  // ###############################################
  
  // provide power for GPS module | set pinMode and digitalWrite for VCC en Ground pins on the Arduino, connected to the GPS module
  pinMode(gpsBoardVCC, OUTPUT);      // sets gpsBoardVCC PIN as output
  digitalWrite(gpsBoardVCC, HIGH);   // connect gpsBoardVCC to 5V
  pinMode(gpsBoardGround, OUTPUT);   // sets gpsBoardGround PIN as output
  digitalWrite(gpsBoardGround, LOW); // connect gpsBoardGround to ground
  
  // ###############################################
  
  Serial.begin(115200);
  ss.begin(GPSBaud);
}

void loop()
{
  // Output raw GPS data to the serial monitor
  while (ss.available() > 0){
    Serial.write(ss.read());
  }
}
