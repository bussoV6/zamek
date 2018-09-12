#include <EtherCard.h>
#include <SoftwareSerial.h>

SoftwareSerial mySerial(4, 5); // RX, TX

// ethernet interface mac address, must be unique on the LAN
static byte mymac[] = { 0x74,0x69,0x69,0x2D,0x30,0x31 };
 
byte Ethernet::buffer[1000];
static uint32_t timer;
String klucz, adres;
 
const char website[] PROGMEM = "zamek-utp.cba.pl";
 
// called when the client request is complete
static void my_callback (byte status, word off, word len) {
  Serial.println("Odpowiedz z serwera");
  Serial.println("=================");
  Ethernet::buffer[off+900] = 0;
  Serial.print((const char*) Ethernet::buffer + off);
  Serial.println("...");
}

static void wyslij()
{
  ether.packetLoop(ether.packetReceive());
  
  if ((millis() > timer) && (klucz != "") ) {
    char * msg[20];
    klucz.toCharArray(*msg, 20);
    timer = millis() + 1000;
    Serial.println();
    Serial.println("<<< Wysylanie klucza");
   
    ether.browseUrl(PSTR("/index.php?"), *msg, website, my_callback);
    klucz="";
  }
}

/*
static void wyswietl()
{
  ether.packetLoop(ether.packetReceive());
    
  if (millis() > timer){
    timer = millis() + 1000;
    Serial.println();
    Serial.println("<<< REQ ");
    ether.browseUrl(PSTR("/index.php?key="), "",  website, my_callback);
  } 
}
*/


static void rfid()
{
  if (mySerial.available())
  {
      klucz = (mySerial.readString());
      Serial.print("<<<< Klucz : ");
      Serial.println(klucz);
  }
}

void setup () {
  mySerial.begin(4800);
  
  Serial.begin(57600);
  Serial.println(F("\n[Zamek szyfrowy - wersja testowa]"));
 
  if (ether.begin(sizeof Ethernet::buffer, mymac) == 0) 
    Serial.println(F("Failed to access Ethernet controller"));
  if (!ether.dhcpSetup())
    Serial.println(F("DHCP failed"));
 
  ether.printIp("IP:  ", ether.myip);
  ether.printIp("GW:  ", ether.gwip);  
  ether.printIp("DNS: ", ether.dnsip);  
 
  if (!ether.dnsLookup(website))
    Serial.println("DNS failed");
    
  ether.printIp("SERWER: ", ether.hisip);
}
 
void loop () {
rfid();
wyslij();

//while(1){};

}
