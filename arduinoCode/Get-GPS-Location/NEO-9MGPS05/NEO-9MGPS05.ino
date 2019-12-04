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

Gpsneo gps;


char latitud[15];
char latitudHemisphere[2];
char longitud[15];
char longitudMeridiano[15];

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
    gps.getDataGPRMC(latitud,latitudHemisphere,longitud,longitudMeridiano);

    Serial.println(latitud);
    Serial.println(latitudHemisphere);
    Serial.println(longitud);
    Serial.println(longitudMeridiano);
}
