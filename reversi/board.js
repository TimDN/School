function Board() {
    this.board = new Array(8);
    this.endMarker = new Array(8);
    this.transformedMarker = new Array(20);
    this.constructor();
}
//Javascript does not support creating multidimensional arrays has to be called before anything else
Board.prototype.constructor = function() {
    for (var i = 0; i < this.board.length; i++) {
        this.board[i] = new Array(8);
        for (j = 0; j < 8; j++) {
            this.board[i][j] = "0";
        }
    }
    for (var i = 0; i < this.endMarker.length; i++) {
        this.endMarker[i] = new Array(2);
        for (j = 0; j < 2; j++) {
            this.endMarker[i][j] = "9";
        }
    }
    for (var i = 0; i < this.transformedMarker.length; i++) {
        this.transformedMarker[i] = new Array(2);
        for (j = 0; j < 2; j++) {
            this.transformedMarker[i][j] = "9";
        }
    }
};
//Places a marker should be called directly after the validMove call with the same marker pos and color;
Board.prototype.placeMarker = function (posX, posZ, color) {
    this.board[posX][posZ] = color;
    //this.transformMarkers(posX,posZ,color);
};
//returns 0 OR 1 depending on if the move is correct also sets all endMarkers[][] that are used in transformMarkers()
Board.prototype.validMove = function(posX, posZ, color) {
    var isValid = 0;
    var reverseColor = "black";
    var i = 0;
    if (color == "white") {
        reverseColor = "black";
    } else {
        reverseColor = "white";
    }
    for (i = 1; i < this.board.length; i++) {
        //Steps out in all directions at the same time and checks if the nearest marker is of the reversecolor
        //and if the next marker after that is of the same color as the placed marker we have found a endMarker[][]
        if (posX - i - 1 >= 0) 
            if (this.board[posX - i][posZ] == reverseColor) {
            if (this.board[posX - i - 1][posZ] == color) {
                alert("posX - i");
                this.endMarker[0][0] = posX - i - 1;
                this.endMarker[0][1] = posZ;
                isValid = 1;
            }
        }
        if (posX - i - 1 >= 0 && posZ + i + 1 <= 7) 
            if (this.board[posX - i][posZ + i] == reverseColor) {
            if (this.board[posX - i - 1][posZ + i + 1] == color) {
                alert("posX - i posZ + i");
                this.endMarker[1][0] = posX - i - 1;
                this.endMarker[1][1] = posZ + i + 1;
                isValid = 1;
            }
        }
        if (posX - i - 1 >= 0 && posZ - i - 1 >= 0) 
            if (this.board[posX - i][posZ - i] == reverseColor) {
            if (this.board[posX - i - 1][posZ - i - 1] == color) {
                alert("posX - i pos> -i");
                this.endMarker[2][0] = posX - i - 1;
                this.endMarker[2][1] = posZ - i - 1;
                isValid = 1;
            }
        }
        if (posX + i + 1 <= 7) 
            if (this.board[posX + i][posZ] == reverseColor) {
            if (this.board[posX + i + 1][posZ] == color) {
                alert("posX + i");
                this.endMarker[3][0] = posX + i + 1;
                this.endMarker[3][1] = posZ;
                isValid = 1;
            }
        }
        if (posX + i + 1 <= 7 && posZ + i + 1 <= 7) 
            if (this.board[posX + i][posZ + i] == reverseColor) {
            if (this.board[posX + i + 1][posZ + i + 1] == color) {
                alert("posX + i posZ + i");
                this.endMarker[4][0] = posX + i + 1;
                this.endMarker[4][1] = posZ + i + 1;
                isValid = 1;
            }
        }
        if (posX + i + 1 <= 7 && posZ - i - 1 >= 0) 
            if (this.board[posX + i][posZ - i] == reverseColor) {
            if (this.board[posX + i + 1][posZ - i - 1] == color) {
                alert("posX + i posZ - i");
                this.endMarker[5][0] = posX + i + 1;
                this.endMarker[5][1] = posZ - i - 1;
                isValid = 1;
            }
        }
        if (posZ + i + 1 <= 7) 
            alert("posZ + i hit1");
            if (this.board[posX][posZ + i] == reverseColor) {
                alert("posZ + i hit2");
            if (this.board[posX][posZ + i + 1] == color) {
                alert("posZ + i hit3");
                alert("posZ + i");
                this.endMarker[6][0] = posX;
                this.endMarker[6][1] = posZ + i + 1;
                isValid = 1;
            }
        }
        if (posZ - i - 1 >= 0) 
            if (this.board[posX][posZ - i] == reverseColor) {
            if (this.board[posX][posZ - i - 1] == color) {
                alert("posZ - i");
                this.endMarker[7][0] = posX;
                this.endMarker[7][1] = posZ - i - 1;
                isValid = 1;
            }
        }
    }
    return isValid;
};
//Checks if there are any spots left on the board
Board.prototype.isFull = function () {
    for (var i = 0; i < 8; i++) {
        for (var j = 0; j < 8; j++) {
            if (this.board[i][j] == 0) {
                return 1;
            }
        }
    }
    return 0;
};
//Transform markers between currentMarkX,currentMarkZ and any positions in endMarkers[][]
Board.prototype.transformMarkers = function (currentMarkX, currentMarkZ, currentMarkColor) {
    var ArrayPos = 0;
    for (var i = 0; i < 8; i++) {
        alert("count: "+i);
        //If a value has replaced the default value of 9
        if (this.endMarker[i][0] != 9) {
            //Calc the Slope between the two points slope = (y2-y1)/(x2-x1)
            var result = (currentMarkZ - this.endMarker[i][1]) / (currentMarkX - this.endMarker[i][0]);
            alert("result :"+result);
            //If the result is -1 or 1 endMarker is on a diagonal
            if (result == -1 || result == 1) {
                if (result == 1) {
                    if (currentMarkX < this.endMarker[i][0]) {
                        for (var j = 1; j < this.endMarker[i][0] - currentMarkX; j++) 
                        {
                            this.board[currentMarkX + j][currentMarkZ + j] = currentMarkColor;
                            this.transformedMarker[ArrayPos][0] = currentMarkX + j;
                            this.transformedMarker[ArrayPos][1] = currentMarkZ + j;
                            ArrayPos ++;
                        }
                    } else {
                        for (var j = 1; j < currentMarkX - this.endMarker[i][0]; j++) {
                            this.board[currentMarkX - j][currentMarkZ - j] = currentMarkColor;
                            this.transformedMarker[ArrayPos][0] = currentMarkX - j;
                            this.transformedMarker[ArrayPos][1] = currentMarkZ - j;
                            ArrayPos ++;
                        }
                    }
                } else {
                    if (currentMarkX < this.endMarker[i][0]) {  
                        for (var j = 1; j < this.endMarker[i][0] - currentMarkX; j++) //Direction,Difference is length
                        {
                            this.board[currentMarkX + j][currentMarkZ - j] = currentMarkColor;
                            this.transformedMarker[ArrayPos][0] = currentMarkX + j;
                            this.transformedMarker[ArrayPos][1] = currentMarkZ - j;
                            ArrayPos ++;
                        }
                    } else {
                        for (var j = 1; j < currentMarkX - this.endMarker[i][0]; j++) {
                            this.board[currentMarkX - j][currentMarkZ + j] = currentMarkColor;
                            this.transformedMarker[ArrayPos][0] = currentMarkX - j;
                            this.transformedMarker[ArrayPos][1] = currentMarkZ + j;
                            ArrayPos ++;
                        }
                    }
                }
            }
            //If current Marker is on the same horizontal line as an end Marker
            else if (currentMarkZ == this.endMarker[i][1]) 
            {
                if (currentMarkX < this.endMarker[i][0]) {
                    for (var j = 1; j < this.endMarker[i][0] - currentMarkX; j++) //Direction,Difference is length
                    {
                        this.board[currentMarkX + j][currentMarkZ] = currentMarkColor;
                        this.transformedMarker[ArrayPos][0] = currentMarkX + j;
                        this.transformedMarker[ArrayPos][1] = currentMarkZ;
                        ArrayPos ++;
                    }
                } else {
                    for (var j = 1; j < currentMarkX - this.endMarker[i][0]; j++) {
                        this.board[currentMarkX - j][currentMarkZ] = currentMarkColor;
                        this.transformedMarker[ArrayPos][0] = currentMarkX - j;
                        this.transformedMarker[ArrayPos][1] = currentMarkZ;
                        ArrayPos ++;
                    }
                }
            }
            //If current Marker is on the same vertical line as an end Marker
            else if (currentMarkX == this.endMarker[i][0]) {
                if (currentMarkZ < this.endMarker[i][1]) {
                    for (var j = 1; j < this.endMarker[i][1] - currentMarkZ; j++) //Direction,Difference is length
                    {
                        this.board[currentMarkX][currentMarkZ + j] = currentMarkColor;
                        this.transformedMarker[ArrayPos][0] = currentMarkX;
                        this.transformedMarker[ArrayPos][1] = currentMarkZ + j;
                        ArrayPos ++;
                    }
                } else {
                    for (var j = 1; j < currentMarkZ - this.endMarker[i][1]; j++) {
                        this.board[currentMarkX][currentMarkZ - j] = currentMarkColor;
                        this.transformedMarker[ArrayPos][0] = currentMarkX;
                        this.transformedMarker[ArrayPos][1] = currentMarkZ - j;
                        ArrayPos ++;
                    }
                }
            }
        }
    }
};