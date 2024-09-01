#include<iostream>
#include<string>

#include <cstdlib>
#include <ctime>
using namespace std;


string suite[4] = { "CLUBS", "DIAMONDS", "HEARTS", "SPADES" };
string cards[13] = { "2", "3", "4", "5", "6", "7","8", "9","10", "JACK", "QUEEN", "KING", "ACE" };

int playerCard;
int computerCard; //kort

int playerValue;
int computerValue; //summan

int playerSuit;
int computerSuit; //klädd


int averageWins;
int averageLoss;
int rounds;
char y;
int computerWin;
int playerWin;

double averageWin(double playerWin, double computerWin) {

	averageWins = playerWin / rounds * 100;
	cout << endl << "You have won an average of: " << averageWins << "%" << endl;

	averageLoss = computerWin / rounds * 100;
	cout << endl << "You have lost an average of: " <<  averageLoss << "%" << endl;

	 return playerWin / computerWin;
} // Räknar ut medelvärdet på vinster samt förluster.

void graphicsShuffle() {
	for (int i = 0; i < 20; i++) {
		cout << endl;

		if (i == 19) {
			cout << "<SHUFFLING DECK>" << endl;
		}
	}
} // Ger ett snyggt avbrott mellan spelen samt "blandar" leken.



void game() {

	while (true) {

			int computerTotal = 0;
			int playerTotal = 0;

	

		while(computerTotal != 2 && playerTotal != 2) {
			playerSuit = rand() % 4;
			computerSuit = rand() % 4;

			playerCard = rand() % 13;
			computerCard = rand() % 13;
			

			if ((playerCard && playerSuit) == (computerCard && computerSuit)) {
				continue;
			} //Säkerställer att loopen "börjar om" ifall samma kort & färg dras.

			cout << "-------------------------------------------- " << endl;
			cout << "You drew: " << cards[playerCard] << " of " << suite[playerSuit] << endl;
			cout << "Computer drew: " << cards[computerCard] << " of " << suite[computerSuit] << endl; //Redovisar första resultatet

			playerValue = playerCard + playerSuit;
			computerValue = computerCard + computerSuit;



			if (computerCard > playerCard) {
				cout << endl << "Computer wins!" << endl;
			

				computerTotal++;


			} // Datorn drar en koll ifall datorn vunnit på kortvalör, och adderar isåfall en vinst.
			else if (playerCard > computerCard) {
				cout << endl << "You win!" << endl;
				
				playerTotal++;
				
				
			} // Datorn kollar ifall spelaren vunnit på kortvalör, och adderar isåfall en vinst.

			else if (playerCard == computerCard) {
				if (playerSuit > computerSuit) {
					
					cout << endl << "You win!" << endl;
	
					playerTotal++;
					

					
				} // Har inte spelaren vunnit på valör drar datorn en check ifall spelaren vunnit på färg, och adderar isåfall en vinst.

				else if (computerSuit > playerSuit) {
					
					cout << endl << "Computer wins!" << endl;

					computerTotal++;
					
					
				}
			} // Har inte datorn vunnit på valör drar datorn en check ifall datorn vunnit på färg, och adderar isåfall en vinst.

		}

		if (computerTotal == 2) {
			rounds++;
			computerWin++;
			cout << "Player lost this game. Player has a total score of: " << playerWin << " games!" << endl;
			cout << "Computer won this game. Computer has a total score of: " << computerWin << " games!" << endl;

			averageWin(playerWin, computerWin);

		}else if (playerTotal == 2) {
			rounds++;
			playerWin++;
			cout << "Player won this game. Player has a total score of: " << playerWin << " games!" << endl;
			cout << "Computer lost this game. Computer has a total score of: " << computerWin << " games!" << endl;
			
			averageWin(playerWin, computerWin);
		}

		cout << "-------------------------------------------- " << endl;
		cout << "Press 'Y' and 'ENTER' to play again. Press any other key to stop playing." << endl;
		cin >> y;

		
		graphicsShuffle();
		

		if ((y != 'Y') && (y != 'y')) {
			break;
		} // Bryter loopen ifall spelaren inte klickar Y.

	}
