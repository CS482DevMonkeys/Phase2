package CS482;
import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.time.LocalDate;
import java.util.Random;

public class UploadData {
	private static final String PLAYERSFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\smallLoad\\Players.txt";
	private static final String GAMESFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\smallLoad\\Games.txt";
	private static final String PLAYFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\smallLoad\\Play.txt";
	
	private static final String MEDIUMPLAYERSFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\mediumLoad\\Players.txt";
	private static final String MEDIUMGAMESFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\mediumLoad\\Games.txt";
	private static final String MEDIUMPLAYFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\mediumLoad\\Play.txt";
	
	private static final String LARGEPLAYERSFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\largeLoad\\Players.txt";
	private static final String LARGEGAMESFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\largeLoad\\Games.txt";
	private static final String LARGEPLAYFILENAME = "C:\\Users\\tonib\\OneDrive\\Documents\\CS482\\largeLoad\\Play.txt";
	
	static public String givenUsingPlainJava_whenGeneratingRandomStringBounded_thenCorrect() {
		  
	    int leftLimit = 97; // letter 'a'
	    int rightLimit = 122; // letter 'z'
	    int targetStringLength = 10;
	    Random random = new Random();
	    StringBuilder buffer = new StringBuilder(targetStringLength);
	    for (int i = 0; i < targetStringLength; i++) {
	        int randomLimitedInt = leftLimit + (int) 
	          (random.nextFloat() * (rightLimit - leftLimit + 1));
	        buffer.append((char) randomLimitedInt);
	    }
	    String generatedString = buffer.toString();
	 
	    return generatedString;
	}
	
	static public LocalDate randomDate(){
		Random random = new Random();
		int minDay = (int) LocalDate.of(1990, 1, 1).toEpochDay();
		int maxDay = (int) LocalDate.of(2020, 1, 1).toEpochDay();
		long randomDay = minDay + random.nextInt(maxDay - minDay);

		LocalDate randomBirthDate = LocalDate.ofEpochDay(randomDay);

		return randomBirthDate;
	}
	
	static public void loadPlayers(int num, String fileName){
		BufferedWriter bw = null;
		FileWriter fw = null;

		try {
			fw = new FileWriter(fileName);
			bw = new BufferedWriter(fw);
			String playerRowToInsert = "";
			String name;
			int PlayerID;
			String team_name;
			Random rand = new Random();
			String positionArray[] = {"QB", "RB", "WR"};
			String position;
			int touchdowns;
			int totalyards;
			int salary;
			
			for(int i = 1; i <= num; i++){
				name = givenUsingPlainJava_whenGeneratingRandomStringBounded_thenCorrect();
				PlayerID = i;
				team_name = givenUsingPlainJava_whenGeneratingRandomStringBounded_thenCorrect();
				int posIndex = rand.nextInt(3); 
				position = positionArray[posIndex];
				touchdowns = rand.nextInt(100);
				totalyards = rand.nextInt(150);
				salary = rand.nextInt(Integer.MAX_VALUE) + 100000;
				playerRowToInsert = playerRowToInsert + name + "," + PlayerID + "," + team_name + "," + position + "," + touchdowns + "," + totalyards + "," + salary + "\r\n";
				
			}
			bw.write(playerRowToInsert);
			System.out.println(playerRowToInsert);			
			System.out.println("Done");

		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				if (bw != null)
					bw.close();
				if (fw != null)
					fw.close();
			} catch (IOException ex) {
				ex.printStackTrace();
			}
		}
	}
	
	static public void loadGames(int num, String fileName){
		BufferedWriter bw = null;
		FileWriter fw = null;

		try {
			fw = new FileWriter(fileName);
			bw = new BufferedWriter(fw);
			String playerRowToInsert = "";
			int GameID;
			LocalDate date;
			String stadium;
			Random rand = new Random();
			String resultArray[] = {"W", "L", "T"};
			String result;
			int attendance;
			int ticket_revenue;
			
			for(int i = 1; i <= num; i++){
				
				GameID = i;
				date = randomDate();
				stadium = givenUsingPlainJava_whenGeneratingRandomStringBounded_thenCorrect();
				int resultIndex = rand.nextInt(3); 
				result = resultArray[resultIndex];
				attendance = rand.nextInt(Integer.MAX_VALUE) + 0;
				ticket_revenue = rand.nextInt(Integer.MAX_VALUE) + 0;
				
				playerRowToInsert = playerRowToInsert + GameID + "," + date + "," + stadium + "," + result + "," + attendance + "," + ticket_revenue + "\r\n";
				
			}
			bw.write(playerRowToInsert);
			System.out.println(playerRowToInsert);			
			System.out.println("Done");

		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				if (bw != null)
					bw.close();
				if (fw != null)
					fw.close();
			} catch (IOException ex) {
				ex.printStackTrace();
			}
		}
	}
	
	static public void loadPlay(int num, String fileName){
		BufferedWriter bw = null;
		FileWriter fw = null;

		try {
			fw = new FileWriter(fileName);
			bw = new BufferedWriter(fw);
			String playerRowToInsert = "";
			int PlayerID;
			int GameID;
			
			for(int i = 1; i <= num; i++){
				
				GameID = i;
				PlayerID = i;
				playerRowToInsert = playerRowToInsert + PlayerID + "," + GameID + "\r\n";
				
			}
			bw.write(playerRowToInsert);
			System.out.println(playerRowToInsert);			
			System.out.println("Done");

		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			try {
				if (bw != null)
					bw.close();
				if (fw != null)
					fw.close();
			} catch (IOException ex) {
				ex.printStackTrace();
			}
		}
	}
	
	public static void main(String[] args) {

		//loadPlayers(100000, "PLAYERSFILENAME");
		loadPlayers(150000, MEDIUMPLAYERSFILENAME);
		loadPlayers(200000, LARGEPLAYERSFILENAME);
		
		loadGames(100000, GAMESFILENAME);
		loadGames(150000, MEDIUMGAMESFILENAME);
		loadGames(200000, LARGEGAMESFILENAME);
		
		loadPlay(100000, PLAYFILENAME);
		loadPlay(150000, MEDIUMPLAYFILENAME);
		loadPlay(200000, LARGEPLAYFILENAME);

	}
}
