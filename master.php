<?php
include 'PhpSerial.php';
// Let's start the class
$serial = new PhpSerial;
// First we must specify the device. This works on both linux and windows (if
// your linux serial device is /dev/ttyS0 for COM1, etc)
$serial->deviceSet("COM4");
// We can change the baud rate, parity, length, stop bits, flow control
$serial->confBaudRate(9600);
$serial->confParity("none");
$serial->confCharacterLength(8);
$serial->confStopBits(1);
$serial->confFlowControl("none");
// Then we need to open it
$serial->deviceOpen();
// To write into

// Or to read from
$read = $serial->readPort();
// If you want to change the configuration, the device must be closed
$serial->deviceClose();
// We can change the baud rate
$serial->confBaudRate(9600);