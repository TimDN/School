function Spelare(xPosition)//Spelare innehåller nuvarande xPosition samt score
		{
			this.xPosition = xPosition;
			this.score = 0;
			this.strikes = 0;
			this.level = 1;
			this.objectTimer = 1400;
		}
		
		Spelare.prototype.increaseLevel = function()
		{
			this.level++;
		}
		
		Spelare.prototype.increaseStrikes = function()
		{
			this.strikes++;
		}
		Spelare.prototype.getStrikes = function()
		{
			return this.strikes;
		}
		Spelare.prototype.increaseScore = function()//sätter score tar inparamteter score för att kunna sätta till 0
		{
			this.score++;
		}
		Spelare.prototype.getScore = function()//Hämtar score
		{
			return this.score;
		}
		Spelare.prototype.getLevel = function()//Hämtar score
		{
			return this.level;
		}
		Spelare.prototype.setXPosition = function(xPosition)
		{
			this.xPosition = xPosition;
		}
		Spelare.prototype.getXPosition = function()
		{
			return this.xPosition;
		}
		
