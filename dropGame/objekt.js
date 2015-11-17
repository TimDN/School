		function Objekt(xPosition,yPosition)//Objekt som skaps deras xPosition används vid kollision y för att flytta dom neråt
		{
			this.xPosition = xPosition;
			this.yPosition = yPosition;
		}
		Objekt.prototype.setYPosition = function(yPosition)
		{
			this.yPosition = yPosition;
		}
		Objekt.prototype.getYPosition = function()
		{
			return this.yPosition;
		}
		Objekt.prototype.getXPosition = function()
		{
			return this.xPosition;
		}