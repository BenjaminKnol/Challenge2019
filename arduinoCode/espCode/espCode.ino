const char* ssid = "dierentuinWifiNaam";
boolean debug = true;

#include "ESP8266WiFi.h"

void setup() {
  // put your setup code here, to run once:
  if (debug) {
    Serial.begin(115200);
  }

  WiFi.mode(WIFI_STA);

  delay(100);

}

void loop() {
  // put your main code here, to run repeatedly:
  WiFi.disconnect();
  WiFi.scanNetworksAsync(checkNetwork);

  //deep sleep
  delay(20000);
}


void checkNetwork(int networksFound) {
  // scan for nearby networks:
  for (int i = 0; i < networksFound; i++)
  {
    Serial.printf("%d: %s %s \n", i + 1, WiFi.SSID(i).c_str(), WiFi.SSID(i).equals("Defqon 1 (d-word for pass)") ? "the one" : "not the one");
  }

}

/* output
 *  2: Ziggo not the one 
3: Ziggo not the one 
4: TP-Link_E03C not the one 
5: Ziggo3145224 not the one 
6: VFNL-AED68A not the one 
7: Harderwijk43 not the one 
8: ZyXELA0C9FF not the one 
9: H369A34959B not the one 
10: TW237 2.4GHz not the one 
11: Defqon 1 (d-word for pass) the one 
12: HZN246298710 not the one 
 */
