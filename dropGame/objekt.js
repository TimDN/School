		function Objekt(xPosition,yPosition)//Objekt som skaps deras xPosition anv�nds vid kollision y f�r att flytta dom ner�t
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