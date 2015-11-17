#include <stdio.h>
#include <stdlib.h>
#include <time.h>

void computerPicksKey(int size,int *symbolUsed,char keyNumbers[]);
void comparisonNumbers(int size,char keyNumbers[],char choosenNumbers[],char feedback[]);
int ifUnique(int size,char *pivot,char comparison[]);
int ifEndOfGame(int size,char feedback[]);
void clearScreen();

int main(void)
{
	int mode = 0,size = 4,gameEnded = 0,symbols = 0,playerTries,symbolUsed = 0;
	char feedback[27],keyNumbers[27],choosenNumbers[27];

	srand(time(NULL));

	printf("---MASTERMIND---\n\n");/*centrera och förstora*/

		printf("The Objective of Masterimind is to find out a secret code that consist of a\n"
		"series of symbols these symbols must be UNIQUE.To help the decoding player find\n"
		"out what the correct numbers are feedback will be recieved after each round.\n"
		"C for a correct guess\n"
		"P symbol exist but is in an incorrect position\n"
		"_ wrong symbol\n"
		"If the correct numbers is 0123 and the player quesses 0375\n"
		"the players feedback will be CP__\n");
		
 clearScreen();

 while(mode != 9)
	{
		printf("1:Normal mode(Computer picks numbers, you find them)\n");
		printf("2:Advanced mode(You play against the computer the least amount of guesses wins)\n");
		printf("3:Versus another player\n");
		printf("4:Choose what type of symbols should be used.Characters(A-Z) or Numbers(0-9)\n");
		printf("5:Choose how many numbers should be used(default value is 4)\n");
		printf("6:Display info\n");
		printf("Exit : 9\n");
		fflush(stdin);
		scanf("%d", &mode);

		clearScreen();

		switch(mode)
		{
			case 1:
				gameEnded = 0;
				playerTries = 0;
				computerPicksKey(size,&symbolUsed,keyNumbers);
				do
				{
					fflush(stdin);
					scanf("%s",&choosenNumbers[0]);
					comparisonNumbers(size,keyNumbers,choosenNumbers,feedback); 
					playerTries ++ ;
				}while((ifEndOfGame(size,feedback)) != 1);

				printf("Congratulations, you have found the code!\n");
				printf("You needed %d tries\n",playerTries);
				clearScreen();

				break;

				case 2:

					break;

				case 3:

					break;

				case 4:

					do
					{
					 printf("Do you want to use 0-9 or A-Z as symbols while playing\n");
					 printf("1:0-9\n");
					 printf("2:A-Z\n");
					 fflush(stdin);
					 scanf("%d",&symbolUsed);
					 clearScreen();
					}while(symbolUsed !=1 && symbolUsed !=2);

					break;

				case 5:

					do
					{
					 printf("Choose the amount of symbols in the key(Max:26 Min:3)\n");
					 fflush(stdin);
					 scanf("%d",&size);
					 clearScreen();
					}while(size<3||size>26);
				
					break;

				case 9:

					printf("Thank you for playing.\n");
					clearScreen();

					break;

					break;
					
				default:
					printf("ERROR: Enter a vaild command\n\n");
					clearScreen();

					break;
			}
 }

	return 0;
}

void computerPicksKey(int size,int *symbolUsed,char keyNumbers[])
{
 int i,range,ascii;

	if(*symbolUsed==0)
	{
		range=9;
		ascii=48;
	}
	else
	{
		range=26;
		ascii=65;
	}
	for(i=0;i < size;i++)
	{
  keyNumbers[i] = (rand()%range)+ascii;
  while((ifUnique(size,&keyNumbers[i],keyNumbers))==1)
   {
    keyNumbers[i] = (rand()%range)+ascii;
   }
	}

return;
}

void comparisonNumbers(int size,char keyNumbers[],char choosenNumbers[],char feedback[])
{
	int i,j;

	for(j=0;j<size;j++)
	{
		for(i=0;i<size;i++)
		{
			feedback[j] = '_';

   if(choosenNumbers[j]==keyNumbers[i])
			{
				if(j==i)
				{
					feedback[j] = 'C';
					i = size;
				}
				else
				{
    feedback[j] = 'P';
				i = size;
				}
			}
		}
	}
	for(i=0;i<size;i++)
	{
		printf("%c",feedback[i]);
	}
	printf("\n");

return;
}

int ifEndOfGame(int size,char feedback[])
{
	int i,finishedSize = 0;

	for(i=0;i<size;i++)
	{
		if(feedback[i] == 'C')
   finishedSize += 1;
	}

	if(finishedSize==size)
		return 1;

	return 0;
}
int ifUnique(int size,char *pivot,char comparison[])
{
	int i;

	for(i=0;i<size;i++)
	{
		if(*pivot==comparison[i])
			if(pivot != &comparison[i])
			{
				return 1;
			}
	}
	return 0;
}

void clearScreen()
{
	fflush(stdin);
	getchar();
 system("cls");
	printf("---MASTERMIND---\n\n");
}

/* Random A-Z variabel är en char rand range 0-25 + 65 vilket för att rand 0 = 65 alltså A */