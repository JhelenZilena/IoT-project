#include <LiquidCrystal.h>
int const LED_RED = 13;
int const FAN1 = 10;
int const sensor = A0;
LiquidCrystal lcd_1(12, 11, 5, 4, 3, 2);

int sensor_value = 0;
float temperature;

void setup()
{
  pinMode (LED_RED, OUTPUT);
  pinMode (FAN1, OUTPUT);
  lcd_1.begin(16, 2);
  Serial.begin(9600);
}

void loop(){
  
  sensor_value = analogRead(sensor);
  temperature = (((sensor_value * (5.0 / 1023.0)) * 100.0)-50.0);
  Serial.print(" Temperature (°C): ");
  Serial.println(temperature);

  lcd_1.clear();
  lcd_1.setCursor(0, 0);
  lcd_1.print("Temperatura:");
  lcd_1.setCursor(0, 1);
  lcd_1.print(temperature);
  lcd_1.print(" C");

if(temperature <= 10 ){
    digitalWrite(LED_RED, HIGH);
    delay(500);
    digitalWrite(LED_RED, LOW);
    delay(500);
    digitalWrite(FAN1, LOW);
}else if(temperature > 11 and temperature <= 25 ){
    digitalWrite(LED_RED, LOW);
    digitalWrite(FAN1, LOW);
}else {
	digitalWrite(LED_RED, HIGH);
    digitalWrite(FAN1, HIGH);
}
  delay(2000);
}