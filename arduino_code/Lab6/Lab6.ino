// C++ code
//
long readUltrasonicDistance(int triggerPin, int echoPin)
{
  pinMode(triggerPin, OUTPUT);  // Clear the trigger
  digitalWrite(triggerPin, LOW);
  delayMicroseconds(2);
  // Sets the trigger pin to HIGH state for 10 microseconds
  digitalWrite(triggerPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(triggerPin, LOW);
  pinMode(echoPin, INPUT);
  // Reads the echo pin, and returns the sound wave travel time in microseconds
  return pulseIn(echoPin, HIGH);
}

void setup()
{
  pinMode(13, OUTPUT);
  pinMode(12, OUTPUT);
  pinMode(8, OUTPUT);
  Serial.begin(115200);
}

void loop()
{
  if (0.01723 * readUltrasonicDistance(2, 3) > 240 && 0.01723 * readUltrasonicDistance(2, 3) < 320) {
    Serial.println("Nivel BAJO: agua en nivel normal");
    digitalWrite(8, HIGH);
  } else {
    digitalWrite(8, LOW);
  }
  if (0.01723 * readUltrasonicDistance(2, 3) > 180 && 0.01723 * readUltrasonicDistance(2, 3) < 239) {
    Serial.println("Nivel MEDIO: agua en aumento");
    digitalWrite(12, HIGH);
  } else {
    digitalWrite(12, LOW);
  }
  if (0.01723 * readUltrasonicDistance(2, 3) > 0 && 0.01723 * readUltrasonicDistance(2, 3) <= 179) {
    
    Serial.println("Nivel ALTO: posible desbordamiento");
    digitalWrite(13, HIGH);
  } else {
    digitalWrite(13, LOW);
  }
  delay(10); // Delay a little bit to improve simulation performance
}
