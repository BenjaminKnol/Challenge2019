#include <TheThingsNetwork.h>

// Set your AppEUI and AppKey
const char *appEui = "70B3D57ED0022E0E";
const char *appKey = "409945AA983522B340F08BAEAD0C1529";

#define loraSerial Serial1
#define debugSerial Serial

// Replace REPLACE_ME with TTN_FP_EU868 or TTN_FP_US915
#define freqPlan TTN_FP_EU868

TheThingsNetwork ttn(loraSerial, debugSerial, freqPlan);

typedef union {
  float f[2];               // Assigning fVal.f will also populate fVal.bytes;
  unsigned char bytes[8];   // Both fVal.f and fVal.bytes share the same 4 bytes of memory.
} floatArr2Val;

floatArr2Val payload;



void setup()
{
  while (digitalRead(2) == LOW) {
  delay(1000);
  debugSerial.println("Going to sleep");
}
//  loraSerial.begin(57600);
//  debugSerial.begin(9600);
//
//  // Wait a maximum of 10s for Serial Monitor
//  while (!debugSerial && millis() < 10000)
//    ;
//  
//    debugSerial.println("-- STATUS");
//    ttn.showStatus();
//
//    debugSerial.println("-- JOIN");
//    ttn.join(appEui, appKey);
}

void loop()
{
  debugSerial.println("-- LOOP");

  double LONG = 56.234464;
  double LANG = 23.345908;
  // Prepare payload of 1 byte to indicate LED status
  payload.f[0] = LONG;
  payload.f[1] = LANG;

  ttn.sendBytes(payload.bytes, sizeof(payload));
  for (int i = 0; i < 8; i++) {
    debugSerial.print(payload.bytes[i], HEX);
    debugSerial.print(" ");
  }

  delay(10000);
}
