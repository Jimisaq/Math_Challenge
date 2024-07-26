import java.io.*;
import java.net.Socket;
import java.nio.file.Files;
import java.util.Arrays;
import java.util.Base64;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
//        System.out.println("Client started..");
        try(Socket soc = new Socket("localhost",2212);){
            BufferedReader in = new BufferedReader(new InputStreamReader(soc.getInputStream()));
            PrintWriter out = new PrintWriter(soc.getOutputStream(),true);

                runClient(out, in);


        }catch(IOException e){
            System.out.println(e.getMessage());
        }
    
    }

    public static void runClient(PrintWriter out, BufferedReader in) throws IOException {
        String request;
        String response;
        Scanner scanner = new Scanner(System.in);
        showMenu();
        outer:do {
            System.out.print("IES_MCS>>");
            request = scanner.nextLine();
            String finalRequest;
            //handle image file sending
            if (request.startsWith("register")) {
                finalRequest = sendImage(request);
                out.println(finalRequest);

            } else{
                out.println(request);
        }
            if(request.equalsIgnoreCase("done")){
                break;
            }

            do {
                response = in.readLine();
                System.out.println(response);
                if(response.equals("logging out...")){
                    break outer;
                }

            } while (!response.isEmpty());

        }while(!request.equalsIgnoreCase("done"));
        runClient(out,in);
        scanner.close();

    }

    public static void showMenu(){
        String instructionSet= """
                                            **WELCOME TO MATHLETICS CHALLENGE SYSTEM**
                Available commands:
                _______________________________________________________________________________________________________________________
                >register <username> <firstname> <lastname> <email> <password> <DateOfBirth> <school_reg_no> <imageFile.png> to register
                >login <p>(pupil)/<sr>(school representative) <username> <password> to log into the system
                >done to exit the system
                -----------------------------------------------------------------------------------------------------------------------
                """;
        System.out.println(instructionSet);

    }
  //send image to the server
  public static String sendImage(String request) throws IOException {
    String encodedString=null;
    String finalRequest = null;
    if (request.startsWith("register")) {
        String[] req = request.split(" ");
        if (req.length == 9) {
            String imageFile = req[8];
            File file = new File(imageFile);
            byte[] fileContent = Files.readAllBytes(file.toPath());
            encodedString = Base64.getEncoder().encodeToString(fileContent);;
            finalRequest = req[0] + " "+req[1] + " "+req[2] + " "+req[3] + " "+req[4] + " "+req[5] + " " +req[6] + " "+req[7] + " "+ encodedString;
        }
    }
    return finalRequest;
}


}

