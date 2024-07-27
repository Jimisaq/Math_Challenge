import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;
import java.util.Properties;
import java.util.ArrayList;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;


public class EmailSender {
    static String sender = "jimisaac8082@gmail.com";
    static Properties properties = System.getProperties();
    static {
        properties.put("mail.smtp.auth", true);
        properties.put("mail.smtp.starttls.enable", true);
        properties.put("mail.smtp.host", "smtp.gmail.com");
        properties.put("mail.smtp.port", "587");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2");
    }

    // send email to school representative after a pupil has registered
    public static void notifySchoolRep(String schoolRegNo, String pupilName) {
        String recipient = Model.getSchoolRepEmail(schoolRegNo);

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });
        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject("New Pupil Registration");
            message.setText("A new pupil by the name " + pupilName
                    + " has registered in your school,,log into the system to confirm their registration");
            Transport.send(message);
            System.out.println("email sent successfully...");
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }

    // send email to pupil after their registration has been confirmed
    public static void notifyPupil(String recipient, String subject, String info) {

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });
        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject(subject);
            message.setText(info);
            Transport.send(message);
            System.out.println("email sent succesfully...");
        } catch (MessagingException e) {
            System.out.println(e.getMessage());
        }

    }

    //a method to write a pdf file and return the file path
    public String createPDF(ArrayList<String> questions, ArrayList<String> solutions, ArrayList<String> answers, ArrayList<String> marks, ArrayList<String> marksAwarded, int score, double timeTaken, String fullName, String email, String challengeName) {
        String filePath = "src/"+fullName+"_"+challengeName+".pdf";
        try {
            Document document = new Document();
            PdfWriter.getInstance(document, new FileOutputStream(filePath));
            document.open();
            document.add(new Paragraph("Challenge name: "+challengeName));
            document.add(new Paragraph("Participant name: "+fullName));
            document.add(new Paragraph("Participant email: "+email));
            document.add(new Paragraph("Score: "+score));
            document.add(new Paragraph("Time taken: "+timeTaken+" minutes"));
            document.add(new Paragraph("Questions attempted: "));
            for (int i=0;i<questions.size();i++){
                document.add(new Paragraph("Question "+(i+1)+": "+questions.get(i)));
                document.add(new Paragraph("Answer: "+solutions.get(i)));
                document.add(new Paragraph("Correct answer: "+answers.get(i)));
                document.add(new Paragraph("Marks: "+marks.get(i)));
                document.add(new Paragraph("Marks awarded: "+marksAwarded.get(i)));
            }
            document.close();
        } catch (DocumentException | FileNotFoundException e) {
            System.out.println(e.getMessage());
        }
        return filePath;
    }

//    private static final ScheduledExecutorService scheduler = Executors.newSingleThreadScheduledExecutor();
//
//    public static void sendChallengeReport(String recipient, List<ChallengeAttempt> attempts) {
//        StringBuilder report = new StringBuilder();
//    //send a detailed report to pupils who participate in challenges after the deadline has passed
//    public static void sendChallengeReport(String recipient, List<ChallengeAttempt> attempts) {
//        StringBuilder report = new StringBuilder();
//
//        report.append("Challenge Report\n");
//        report.append("-----------------\n");
//        report.append("Email | Username | First Name\n");
//        report.append("-----------------\n");
//
//        for (ChallengeAttempt attempt : attempts) {
//            report.append(attempt.getEmail()).append(" | ").append(attempt.getUsername()).append(" | ").append(attempt.getFirstName()).append("\n");
//            report.append("-----------------\n");
//
//            report.append("Question | Score | Time Taken\n");
//            report.append("-----------------\n");
//            for (QuestionAttempt questionAttempt : attempt.getQuestionAttempts()) {
//                report.append(questionAttempt.getQuestion()).append(" | ").append(questionAttempt.getScore()).append(" | ").append(questionAttempt.getTimeTaken()).append("\n");
//                report.append("-----------------\n");
//            }
//
//            report.append("Total Time Taken: ").append(attempt.getTotalTimeTaken()).append("\n");
//            report.append("-----------------\n");
//        }
//
//        scheduler.schedule(() -> {
//            sendReport(recipient, report.toString());
//        }, 1, TimeUnit.DAYS); // Adjust the delay and time unit as needed
//    }
//
//        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
//            protected PasswordAuthentication getPasswordAuthentication() {
//                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
//            }
//        });
//        try {
//            MimeMessage message = new MimeMessage(session);
//            message.setFrom(new InternetAddress(sender));
//            message.addRecipient(MimeMessage.RecipientType.TO, new InternetAddress(recipient));
//            message.setSubject("Challenge Report");
//            message.setText(report.toString());
//            Transport.send(message);
//            System.out.println("Report sent successfully...");
//        } catch (MessagingException e) {
//            System.out.println(e.getMessage());
//        }
//    }
}