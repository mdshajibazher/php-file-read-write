<?php

$filename = getcwd()."/data/data.txt";

//check if file is readable
if(is_readable($filename)){

//General Way to read one line per fgets() opearion
echo "--General Way Start-- \n";
$fp = fopen($filename,'r');
$readOnelineUntilNewLineAppear = fgets($fp);
$readOnelineUntilNewLineAppearOnlyTwoCharecter = fgets($fp,3);
echo $readOnelineUntilNewLineAppear."\n";
echo $readOnelineUntilNewLineAppearOnlyTwoCharecter."\n";
fclose($fp);
echo "--General Way End-- \n";

//Using While Loop Read all line
echo "--Looping Way Start--\n";
$fp = fopen($filename,'r');
while($line = fgets($fp)){
    echo $line."\n";
}

//Move pointer to first postion start printing again
echo "Move pointer to first postion start printing again\n";
rewind($fp);
while($line = fgets($fp)){
    echo $line."\n";
}

//Move pointer to specific postion start printing again
fseek($fp,3);
echo "Move pointer to specific  postion eg: second position start printing again\n";
while($line = fgets($fp)){
    echo $line."\n";
}
fclose($fp);

echo "--Looping Way End--\n";


//Read all data at a glance
echo "--using file() function Read all data at a glance-- \n";
$data = file($filename);
//It gives us an array of every line
print_r($data);

echo "--using file_get_contents() function Read all data at a glance-- \n";

$data = file_get_contents($filename);
echo $data;

}

$filenameForWrite = getcwd()."/data/data-write.txt";
//Data Write
echo "Check if file is writeable\n";
if(is_writable($filenameForWrite)){
echo "--Start data write in 'w' mode --\n";
echo "warn: it will erase existing data\n";
//Note: it will erase previous data and write again

$fp = fopen($filenameForWrite,"w");
fwrite($fp,"Something\n");
fwrite($fp,"Another Something\n");
fwrite($fp,"Again Another Something\n");
fclose($fp);
echo "--Start data write in 'a' or Append mode --\n";
//Note: it will erase previous data and write again
$filenameForWrite = getcwd()."/data/data-write.txt";
$fp = fopen($filenameForWrite,"a");
fwrite($fp,"Something appended with previous data\n");
fwrite($fp,"Another Something appended with previous data\n");
fclose($fp);

//Most Easy way to file write
echo " file_put_contents() Most Easy way to file write\n";
echo "warn: file_put_contents() will erase existing data if no flag passed\n";
$text = "Lorem ipsum dolor sit amet \n 
Some text 
In another line\n
";
file_put_contents($filenameForWrite,$text);
echo "Persist existing data in file_put_contents\n";
$appendedText = "Hello World appended\n";
$appendedText2 = "something appended\n";
file_put_contents($filenameForWrite,$appendedText,FILE_APPEND);
//Prevent res condition
echo "Prevent loss data in res condition\n";
file_put_contents($filenameForWrite,$appendedText2,FILE_APPEND | LOCK_EX);
}