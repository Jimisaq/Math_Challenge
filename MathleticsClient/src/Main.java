import java.io.*;
import java.net.Socket;
import java.util.Arrays;
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
        outer:do{
            System.out.print("IES_MCS>>");
            request = scanner.nextLine();
            //sendImage(request,out);

            out.println(request);
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
                                            **WELCOME TO IES MATH CHALLENGE SYSTEM**
                Available commands:
                _______________________________________________________________________________________________________________________
                >register <username> <firstname> <lastname> <email> <password> <DateOfBirth> <school_reg_no> <imageFile.png> to register
                >login <p>(pupil)/<sr>(school representative) <username> <password> to log into the system
                >done to exit the system
                -----------------------------------------------------------------------------------------------------------------------
                """;
        System.out.println(instructionSet);

    }
    //turn an image into a byte stream and send the bytestream to the server
    public static void sendImage(String request, PrintWriter out){
      String[] req= request.trim().split(" ");
      String filePath = req[8];
      File file = new File(filePath);

        try (FileInputStream fis = new FileInputStream(file);
             BufferedInputStream bis = new BufferedInputStream(fis);
        ){
           out.println(file.getName());
           out.println(file.length());

              byte[] buffer = new byte[1024];
                int bytesRead;
                while ((bytesRead = bis.read(buffer)) != -1) {
                    out.write(Arrays.toString(buffer), 0, bytesRead);
                }
        } catch (IOException e) {
            System.out.println(e.getMessage());
        }



    }
}
