#include <iostream> //Låter programmet få tillgång till Input och Output från användaren. 
#include <cstdlib> //Låter programmet använda funktioner i c standard biblioteket.
#include <ctime> //Låter programmet jobba med tid. Nödvändigt för att randomfunktionen ska fungera.
#include <cstring> //Låter programmet jobba med strings, alltså rader med text.
using namespace std; //Underlättar för programmeraren då det standardiserar språket. Man slipper alltså skriva std :: innan många kodrader.

int main()
{
	int bet1, saldo;
	char Y;
	char N;
	
	cout << "Welcome to the dice game!" << endl << "The game is Best of 3, the player has to have a higher score in 2 dice rounds than the computer to win. First to 2 rounds win!" << endl;		
	                                   
	cout << "Please deposit an amount of 100-5000kr" << endl << endl;
	
	cin >> saldo;
	if ((saldo >=100) && (saldo <=5000)) {
		cout << "You have deposited " << saldo << "kr " << "To your account!" << endl << endl;
	}

	while ((saldo < 100) || (saldo > 5000)){
		cout << "Not a valid amount, please try again" << endl;
		cin >> saldo;
	}														//Rad 16-28 Välkomnar spelaren, informerar om regler och låter användaren sätta in pengar att spela för.
															//Den validerar även att spelaren satt in rätt mängd pengar enligt krav.
	cout << "Do you want to start round one or do you wish to exit now?" << endl << "If you exit now, your funds will be returned to your account." << endl << "Press 'Y'and 'ENTER' to continue. If you wish to exit, press any other key." << endl;
	cin >> Y;
	if (Y == 'Y' || Y == 'y') {
		cout << "You have chosen to start round one" << endl << endl;
	}

	else {
		cout << "You have chosen to exit the game. Your balance of: " << saldo << "kr " << " will be deposited back to your bank account." << endl;
		exit(0);
	}														//Rad 30-39 Informerar spelaren att det fortfarande går att ångra sig och ta ut sina pengar. Spelaren kan också välja att fortsätta.
	
	cout << "Now it's time to bet, your money will be drawn from your balance. Do you wish to proceed?" << endl << "If you want to proceed, Press 'Y' + 'ENTER' on your keyboard. If not, press any other key." << endl << endl;
	cin >> Y;
	if ((Y =='Y') || (Y == 'y')) {
		cout << "You have agreed to the terms." << endl << endl << "Your current balance is: " << saldo << "kr" << endl << endl;
	}
	else{
		cout << "You have not agreed to the terms and the game will be terminated." << endl << "Your current balance of: " << saldo << "kr" << " has been transferred back to your account." << endl;
		exit(0);
	}
	cout << "Please place a bet. 100, 300, 500kr and press 'ENTER' to continue." << endl;
	cin >> bet1;						//Rad 41-51 Låter användaren satsa pengar inför spelet samt redovisa saldo. Den ger också användaren en sista möjlighet att avbryta spelet innan pengar dras från kontot.
															
	while ((bet1 != 100 && bet1 !=300 && bet1 !=500) || (saldo < bet1)) {
		cout << "Please place a valid bet" << endl;
		cin >> bet1;
	}
	if ((bet1 == 100) || (bet1 == 300) || (bet1 == 500)) {
		cout << "Your bet is: " << bet1 << "kr " << "And you now have: " << saldo - bet1 << "kr " << "Remaining on your account." << endl;
	}														//Rad 53-59 Validerar att spelaren spelar för rätt mängd pengar enligt kravsättning. Samt redovisa saldo.
	//---------------------------------------------------------------------------------------------------------------------------------------
		int pDice1, cDice1;

		char y;

		srand(time(0));
		pDice1 = rand() % 6 + 1;
	
		cDice1 = rand() % 6 + 1;

		string winner;


		int pWin = 0;
		int cWin = 0;					//Rad 61-74 initierar bara nya variabler. Detta då jag ser detta som ett nytt "block" och det blev lättare att lämna introduktionen ovan och börja med spelfunktionen.

		while (true) {
			int pWin = 0, cWin = 0;		//Rad 76-79 Används för att skapa en oändlig loop där variablerna återställs för att kunna säkerställa att spelet ska kunnas spelas om och om igen.
			while (pWin != 2 && cWin != 2) { //Rad 78 loopen säkerställer att ingen har uppnåt 2 vinster i spelet.
				int pDice1 = rand() % 6 + 1;
				int cDice1 = rand() % 6 + 1; 
				int pDice2 = rand() % 6 + 1;
				int cDice2 = rand() % 6 + 1;
				cout << "Player score is: " << pDice1 + pDice2 << endl;
				cout << "Computer score is: " << cDice1 + cDice2<< endl;		//Rad 79-85 Initierar tärningarna och visar vilken poäng respektive aktör fick.

				if (cDice1 + cDice2 > pDice1 + pDice2) {
					cout << "Computer wins!" << endl << endl;
					cWin++;
				}
				else if (pDice1 + pDice2 > cDice1 + cDice2) {
					cout << "Player wins!" << endl << endl;
					pWin++;
				}
				else {
					cout << "It's a draw!" << endl << endl;
				}						//Rad 86-96 Lägger till en vinst för vinnaren eller informerar om oavgjort. Detta för att Rad 78 loopen ska förstå om någon har uppnåt 2 vinster.
			}

			string winner = pWin > cWin ? "Player" : "Computer";
			if (winner == "Player") {
				cout << "You win!: " << bet1 * 2 << "kr" << endl;
				cout << "And your current balance is: " << saldo + bet1 << "kr" << endl << endl;
				saldo = saldo + bet1;
			}

			else if (winner == "Computer") {
				cout << "Sorry, you lost." << endl;
				cout << "Your current balance is: " << saldo - bet1 << "kr" << endl;
				saldo = saldo - bet1;
			}							//Rad 99-110 Deklarerar en vinnare och informerar spelaren om hen har vunnit eller förlorat. Den redovisar även vinstsumman och innestående saldo.

			cout << winner << " wins this round! Press 'Y' + 'ENTER' to continue playing. Press any other key to quit the game and withdraw your money. " << endl << endl;
			char y;
			cin >> y;
			if ((y != 'y') && (y != 'Y')) {
				cout << "You have chosen to abort the game. Your current balance of: " << saldo << "kr " << "Has been transferred back to your account." << endl << endl;
				break;
			}							//Rad 112-118  Ger spelaren möjlighet att forsätta spela eller avsluta spelet.

			if (saldo < 100) {
				cout << "Sorry, you don't have sufficient funds on your account." << endl << "The game will be terminated and your current saldo of: " << saldo << "kr " << "Will be transferred back to your account." << endl;
				cout << "If you want to keep playing, please restart the game and make a new deposit." << endl << endl << endl;
				break;
			}					//Rad 120-124 Stänger automatiskt av spelet om spelaren inte har tillräckligt med pengar.

			cout << "Please place a bet of 100, 300 or 500kr" << endl;
			cin >> bet1;
			while ((bet1 != 100 && bet1 != 300 && bet1 != 500) || (saldo < bet1)) {
				cout << "Please place a valid bet" << endl;
				cin >> bet1;
			}

			if (y != 'y') {
				break;
			}
		}							//Rad 125 Säkerställer att spelaren satsar pengar enligt kravsättning om spelet fortsätts.
}
