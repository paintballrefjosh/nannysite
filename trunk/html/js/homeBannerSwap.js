
//The array which is going to hold the image information. Store the image info along with their correct path; I've omitted the path here as I've stored the images in the same folder where my web page resides.
var imageArray = new Array();

//imageArray[0] = "pci_compliance_home_img"; 
imageArray[0] = "ema_home_img";
imageArray[1] = "inc500_home_img";
//imageArray[2] = "nexpose_home_img";


function doIt()
{
var rand = Math.floor(Math.random()*2); //Generating a random number - this number should equal the total number of items in the array.

var imgPath = "<img src='/img/"+imageArray[rand]+".gif' border='0'  usemap='#" + imageArray[rand] + "' />";

document.getElementById("homePCI").innerHTML = imgPath;

}

