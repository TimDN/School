function Spelare(xPosition)//Spelare inneh�ller nuvarande xPosition samt score
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
		Spelare.prototype.increaseScore = function()//s�tter score tar inparamteter score f�r att kunna s�tta till 0
		{
			this.score++;
		}
		Spelare.prototype.getScore = function()//H�mtar score
		{
			return this.score;
		}
		Spelare.prototype.getLevel = function()//H�mtar score
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
		
