/* Script gedownload vanaf https://www.hackster.io/ruchir1674/how-to-interface-arduino-mega-with-neo-6m-gps-module-1b7283
   Alleen alles wat tussen // ############################################### en // ############################################### staat heb ik zelf aangepast, de rest is origineel
*/




// LET OP!! Andere PIN configuratie als gebruikelijk!!


// NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!!
// NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!! NIET gebruiken met Arduino UNO!!

// Sketch is voor Arduino Mega gemaakt en PIN's kloppen niet voor de Uno
// De variabelen heb ik onderaan wel neergezet, maar deze worden nog niet gebruikt >> fix dit



// ###############################################

// create variables for board pins
int gpsBoardTX = 4;
int gpsBoardRX = 5;
int gpsBoardGround = 6;
int gpsBoardVCC = 7;

// ###############################################


//Connect with pin 18 and 19
#include <TinyGPS.h>
//long   lat,lon; // create variable for latitude and longitude object
float lat,lon;
TinyGPS gps; // create gps object

void setup(){
  // ###############################################
  
  // provide power for GPS module | set pinMode and digitalWrite for VCC en Ground pins on the Arduino, connected to the GPS module
  pinMode(gpsBoardVCC, OUTPUT);      // sets gpsBoardVCC PIN as output
  digitalWrite(gpsBoardVCC, HIGH);   // connect gpsBoardVCC to 5V
  pinMode(gpsBoardGround, OUTPUT);   // sets gpsBoardGround PIN as output
  digitalWrite(gpsBoardGround, LOW); // connect gpsBoardGround to ground
  
  // ###############################################
  
Serial.begin(57600); // connect serial
Serial.println("The GPS Received Signal:");
Serial1.begin(9600); // connect gps sensor

}
 
void loop(){
    while(Serial1.available()){ // check for gps data
    if(gps.encode(Serial1.read()))// encode gps data
    { 
    gps.f_get_position(&lat,&lon); // get latitude and longitude

    Serial.print("Position: ");
    
    //Latitude
    Serial.print("Latitude: ");
    Serial.print(lat,6);
    
    Serial.print(",");
    
    //Longitude
    Serial.print("Longitude: ");
    Serial.println(lon,6); 
    
   }
  }
} 

/*
//Connect with pin 16 and 17
#include <TinyGPS.h>
//long   lat,lon; // create variable for latitude and longitude object
float lat,lon;
TinyGPS gps; // create gps object

void setup(){
Serial.begin(57600); // connect serial
Serial.println("The GPS Received Signal:");
Serial2.begin(9600); // connect gps sensor

}
 
void loop(){
    while(Serial2.available()){ // check for gps data
    if(gps.encode(Serial2.read()))// encode gps data
    { 
    gps.f_get_position(&lat,&lon); // get latitude and longitude

    Serial.print("Position: ");
    
    //Latitude
    Serial.print("Latitude: ");
    Serial.print(lat,6);
    
    Serial.print(",");
    
    //Longitude
    Serial.print("Longitude: ");
    Serial.println(lon,6); 
    
   }
  }
}
*/


/*//Connect with pin 14 and 15
#include <TinyGPS.h>
//long   lat,lon; // create variable for latitude and longitude object
float lat,lon;
TinyGPS gps; // create gps object

void setup(){
Serial.begin(57600); // connect serial
Serial.println("The GPS Received Signal:");
Serial3.begin(9600); // connect gps sensor

}
 
void loop(){
    while(Serial3.available()){ // check for gps data
    if(gps.encode(Serial3.read()))// encode gps data
    { 
    gps.f_get_position(&lat,&lon); // get latitude and longitude

    Serial.print("Position: ");
    
    //Latitude
    Serial.print("Latitude: ");
    Serial.print(lat,6);
    
    Serial.print(",");
    
    //Longitude
    Serial.print("Longitude: ");
    Serial.println(lon,6); 
    
   }
  }
}*/
