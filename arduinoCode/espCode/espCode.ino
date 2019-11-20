#define uS_TO_S_FACTOR 1000000  //Conversion factor for micro seconds to seconds
#define TIME_TO_SLEEP 5 // in seconds

char* CheckSsid = "Defqon 1 (d-word for pass)";

boolean debug = true;
bool inBounds = true;

#include "ESP8266WiFi.h"

void setup() {
  // put your setup code here, to run once:
  if (debug) {
    Serial.begin(115200);
  }
  while (!Serial) {}
  Serial.println("startup");

  WiFi.mode(WIFI_STA);



}

void loop() {
  // put your main code here, to run repeatedly:
  WiFi.disconnect();
  WiFi.scanNetworksAsync(checkNetwork);
  if (inBounds) {
    Serial.println("ik na naar bed");
    ESP.deepSleep(TIME_TO_SLEEP * uS_TO_S_FACTOR);
  } else {
    while (true) {
      Serial.println("De vogel is gejat");
      delay(500);
    }
  }


}


void checkNetwork(int networksFound) {
  // scan for nearby networks:
  bool networkFound = false;
  for (int i = 0; i < networksFound; i++)  {
    //Serial.printf("%d: %s %s \n", i + 1, WiFi.SSID(i).c_str(), WiFi.SSID(i).equals(CheckSsid) ? "the one" : "not the one");
    if (WiFi.SSID(i).equals(CheckSsid)) {
      networkFound = true;
      break;
    }
  }
  if (!networkFound) {
    inBounds = false;
  }

}
