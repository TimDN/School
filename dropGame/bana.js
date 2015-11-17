function Bana(startX,startY)//Banor innehåller deras startpositioner och storlek
{
	this.startX = startX;
	this.startY = startY;
	this.width = 320;
	this.height = 500;
	this.objectTimer = 1400;
	this.dropTimer = 30;
}

Bana.prototype.getYBounds = function()//Hämtar bana max Y används vid spawn av objekt
{
	return this.height;
}

Bana.prototype.increaseDropTimer = function()
{
	this.dropTimer = this.dropTimer - 2;
}

Bana.prototype.increaseObjectTimer = function()
{
	this.objectTimer = this.objectTimer - 80;
}

Bana.prototype.getObjectTimer = function()
{
	return this.objectTimer;
}

Bana.prototype.getDropTimer = function()
{
	return this.dropTimer;
}