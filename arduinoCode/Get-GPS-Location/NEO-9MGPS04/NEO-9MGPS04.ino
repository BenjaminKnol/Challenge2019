/* Script gedownload vanaf https://cristiansteib.github.io/Gps-neo-6m
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
#include <Gpsneo.h>

Gpsneo gps(gpsBoardTX,gpsBoardRX); // Call the contructor for the Class.      // Aangepast. Regel was eerst: Gpsneo gps();
char time[10];
char status[2];
char latitud[15];
char latitudHemisphere[2];
char longitud[15];
char longitudMeridiano[15];
char speedKnots[10];
char trackAngle[8];
char date[10];
char magneticVariation[10];
char magneticVariationOrientation[2];


void  setup()
{
  
  // ###############################################
  
  // provide power for GPS module | set pinMode and digitalWrite for VCC en Ground pins on the Arduino, connected to the GPS module
  pinMode(gpsBoardVCC, OUTPUT);      // sets gpsBoardVCC PIN as output
  digitalWrite(gpsBoardVCC, HIGH);   // connect gpsBoardVCC to 5V
  pinMode(gpsBoardGround, OUTPUT);   // sets gpsBoardGround PIN as output
  digitalWrite(gpsBoardGround, LOW); // connect gpsBoardGround to ground
  
  // ###############################################
  
    Serial.begin(9600);
}
void loop()
{
    //Just simple do getDataGPRMC, and the method solve everything.
    gps.getDataGPRMC(
                     time,status, latitud, latitudHemisphere, longitud,
                     longitudMeridiano, speedKnots,trackAngle, date,
                     magneticVariation, magneticVariationOrientation
                     );

   Serial.println(time);
   Serial.println(status);
   Serial.println(latitud);
   Serial.println(latitudHemisphere);
   Serial.println(longitud);
   Serial.println(longitudMeridiano);
   Serial.println(speedKnots);
   Serial.println(trackAngle);
   Serial.println(date);
   Serial.println(magneticVariation);
   Serial.println(magneticVariationOrientation);
}
