#include <TheThingsNetwork.h>

// Set your AppEUI and AppKey
const char *appEui = "70B3D57ED0022E0E";
const char *appKey = "3D8E1D43DDD517D9DF89C1825B3F76EA";

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
  loraSerial.begin(57600);
  debugSerial.begin(9600);

  // Wait a maximum of 10s for Serial Monitor
  while (!debugSerial && millis() < 10000)
    ;
  
    debugSerial.println("-- STATUS");
    ttn.showStatus();

    debugSerial.println("-- JOIN");
    ttn.join(appEui, appKey);
}

void loop()
{
  debugSerial.println("-- LOOP");

  double xCoord = 56.234464;
  double yCoord = 23.345908;
  // Prepare payload of 1 byte to indicate LED status
  payload.f[0] = xCoord;
  payload.f[1] = yCoord;

  ttn.sendBytes(payload.Bytes, sizeof(payload));
  for (int i = 0; i < 8; i++) {
    debugSerial.print(payload.bytes[i], HEX);
    debugSerial.print(" ");
  }

  delay(10000);
}
