#include <Arduino.h>
#include <WiFi.h>
#include <AsyncTCP.h>
#include <ESPAsyncWebServer.h>
#include "SPIFFS.h"
#include <Stepper.h>

#define dir 14
#define step1 12
#define step2 12

volatile boolean c1 = 0;
volatile unsigned int pt1 = millis();

const int sense_24V_pin=33,sense_5V_pin=25,lean_pin=26;
double len;
int n_5v=0,l=0,n_24v=0;
float sense_5v=0,sense_24v=0;

String sen_5v,ln,sen_24v, sense_state_24, sense_state_5, sense_state_sol1;
String message = "";

// Replace with your network credentials
const char* ssid = "POCO X3 Pro";
const char* password = "12344321";

// Create AsyncWebServer object on port 80
AsyncWebServer server(80);

// Create a WebSocket object
AsyncWebSocket ws("/ws");

//Variables to save values from HTML form
String direction ="STOP";
String steps;
String chickmotor;

bool newRequest = false;

// Initialize SPIFFS
void initSPIFFS() {
  if (!SPIFFS.begin(true)) {
    Serial.println("An error has occurred while mounting SPIFFS");
  }
  else{
    Serial.println("SPIFFS mounted successfully");
  }
}

// // Initialize WiFi
// void initWiFi() {
//   Serial.print("Setting AP (Access Point)…");
//   WiFi.softAP(ssid, password, 1, 0, 1);

//   IPAddress IP = WiFi.softAPIP();
//   Serial.print("AP IP address: ");
//   Serial.println(IP);
// }
void initWiFi() {
    WiFi.mode(WIFI_STA);
    WiFi.begin(ssid, password);
    Serial.print("Connecting to WiFi ..");
    while (WiFi.status() != WL_CONNECTED) {
        Serial.print('.');
        delay(1000);
    }
    Serial.println(WiFi.localIP());
}

void notifyClients(String state) {
  ws.textAll(state);
}

void handleWebSocketMessage(void *arg, uint8_t *data, size_t len) {
  AwsFrameInfo *info = (AwsFrameInfo*)arg;
  if (info->final && info->index == 0 && info->len == len && info->opcode == WS_TEXT) {
    data[len] = 0;
    message = (char*)data;
    steps = message.substring(0, message.indexOf("&"));
    direction = message.substring(message.indexOf("&")+1, message.length());
    chickmotor = message.substring(message.indexOf("&&")+1, message.length());

    Serial.print("steps");
    Serial.println(steps);
    Serial.print("direction");
    Serial.println(direction);
    Serial.print("chickmotor");
    Serial.println(chickmotor);

    notifyClients(direction);
    newRequest = true;
  }
}

void onEvent(AsyncWebSocket *server, AsyncWebSocketClient *client, AwsEventType type, void *arg, uint8_t *data, size_t len) {
  switch (type) {
    case WS_EVT_CONNECT:
      Serial.printf("WebSocket client #%u connected from %s\n", client->id(), client->remoteIP().toString().c_str());
      //Notify client of motor current state when it first connects
      notifyClients(direction);
      break;
    case WS_EVT_DISCONNECT:
      Serial.printf("WebSocket client #%u disconnected\n", client->id());
      break;
    case WS_EVT_DATA:
        handleWebSocketMessage(arg, data, len);
        // sense_5v_power_supply();
        // sense_24v_power_supply();
        // get_sol_concentration();
        break;
    case WS_EVT_PONG:
    case WS_EVT_ERROR:
     break;
  }
}

void initWebSocket() {
  ws.onEvent(onEvent);
  server.addHandler(&ws);
}

void  stepper_motor(int steps, int direction, String num)
{
  Serial.print("a");

  int motornum;
  if (num == "M1")
  {
    motornum = step1;
  }
  else if(num == "M2")
  {
    motornum = step2;
  }
  unsigned long ct1 = millis();
      Serial.print("b");

  while (steps)
  {
    ct1 = millis();
  if ((ct1 - pt1 > 50) && c1 == 1)
  {
    digitalWrite(dir, direction);
    digitalWrite(motornum, HIGH);
    c1 = 0;
    Serial.print(pt1);
    Serial.print(" ");

    pt1 = ct1;
  }
  if (ct1 - pt1 > 50 && c1 == 0)
  {
    digitalWrite(motornum, LOW);
    c1 = 1;
    steps--;
    pt1 = ct1;
    }
  }
}

double f(double x) {
  return  
 1.9797073746014478e-002
+ 1.8393528260227294e+000 * x
-7.2180498969680524e+000  * pow(x, 2)
+ 1.1750987376966094e+001 * pow(x, 3)
+ 2.4374805177828307e-001 * pow(x, 4)
-3.1448747433061925e+001  * pow(x, 5)
+ 5.3281605264179291e+001 * pow(x, 6)
-4.4089414888134570e+001  * pow(x, 7)
+ 1.9828416412589252e+001 * pow(x, 8)
-3.9460944648654399e+000  * pow(x, 9)
-3.9902835044845286e-001  * pow(x, 10)
+ 3.8743552873596565e-001 * pow(x, 11)
-7.7685104905477045e-002  * pow(x, 12)
+ 5.4799068241376927e-003 * pow(x, 13);

}

String sense_5v_power_supply()
{
     n_5v=analogRead(sense_5V_pin);
     sense_5v=(n_5v/4095.0)*5;
     sen_5v="power_supply_5v_check = ";
     String temp=String(sense_5v);
     sen_5v=sen_5v+temp+" v";
     return sen_5v;
}

String sense_24v_power_supply()
{
     n_24v=analogRead(sense_24V_pin);
     sense_5v=(n_24v/4095.0)*24;
     sen_24v="power_supply_24v_check = ";
     String temp1=String(sense_24v);
     sen_24v=sen_24v+temp1+" v";
     return sen_24v;
}


String get_volt()
{
 l=analogRead(lean_pin);
 len=(l/4095.0)*3.3;
 len=len+f(len);
 ln="potentiometer voltage drop = ";
 String t=String(len);
 ln=ln+t+" v";
 return ln;
}

String processor(const String& var){
  Serial.println(var);
  Serial.println(sense_5v_power_supply());

  if(var == "STATE_5"){
    sense_state_5 = sense_5v_power_supply();
    return sense_state_5;
  }

  if(var == "STATE_24"){
    sense_state_24 = sense_24v_power_supply();
    return sense_state_24;
  }

  // if(var == "STATE_sol1"){
  //   sense_state_sol1 = get_sol_concentration();
  //   return sense_state_sol1;
  // }

  return String();
}

void setup() {
  // Serial port for debugging purposes
  Serial.begin(115200);

  pinMode(12, OUTPUT);
  pinMode(14, OUTPUT);
  
  initWiFi();
  initWebSocket();
  initSPIFFS();
  //myStepper.setSpeed(5);

  // Web Server Root URL
  server.on("/", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send(SPIFFS, "/index.php", "text/html");
  });

  // server.on("/", HTTP_GET, [](AsyncWebServerRequest *request){
  //   request->send(SPIFFS, "/index.html", "text/html", String(), processor);
  // });

  server.on("/style.css", HTTP_GET, [](AsyncWebServerRequest *request){
    request->send(SPIFFS, "/style.css", "text/css");
  });

  server.serveStatic("/", SPIFFS, "/");
  
  server.begin();
}

void loop() {
  // ws.loop();

  if (newRequest)
  {
    if (direction == "CW"){
      // digitalWrite(dir,HIGH);
      // for(int i=0;i<steps.toInt();i++)
      // {
      //   digitalWrite(step,HIGH);
      //   delay(100);
      //   digitalWrite(step,LOW);
      //   delay(100);
      //   Serial.print("CW");
      // }
      //myStepper.step(steps.toInt());
      stepper_motor(steps.toInt(), 1, chickmotor);
      
    }
    else{
      //  digitalWrite(dir,LOW);
      // for(int i=0;i<steps.toInt();i++)
      // {
      //   digitalWrite(step,HIGH);
      //   delay(100);
      //   digitalWrite(step,LOW);
      //   delay(100);
      //   Serial.print("CCW");
      // }
      // //myStepper.step(-steps.toInt());
      stepper_motor(steps.toInt(), 0, chickmotor);
    }
    newRequest = false;
    notifyClients("stop");
  }
  ws.cleanupClients();
}