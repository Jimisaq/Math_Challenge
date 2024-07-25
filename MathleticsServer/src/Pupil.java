import javax.mail.*;
import javax.mail.internet.*;
import com.itextpdf.text.*;
import com.itextpdf.text.pdf.*;
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.IOException;
import java.util.List;
import java.util.Properties;
import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;

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
            message.addRecipient(Message.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject("New Pupil Registration");
            message.setText("A new pupil by the name " + pupilName + " has registered in your school. Log into the system to confirm their registration.");
            Transport.send(message);
            System.out.println("Email sent successfully...");
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }

    public static void notifyPupil(String recipient, String subject, String info) {
        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });

        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(Message.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject(subject);
            message.setText(info);
            Transport.send(message);
            System.out.println("Email sent successfully...");
        } catch (MessagingException e) {
            System.out.println(e.getMessage());
        }
    }

    private static final ScheduledExecutorService scheduler = Executors.newSingleThreadScheduledExecutor();

    public static void sendChallengeReport(String recipient, List<ChallengeAttempt> attempts) {
        ByteArrayOutputStream pdfOutputStream = new ByteArrayOutputStream();
        Document document = new Document();

        try {
            PdfWriter.getInstance(document, pdfOutputStream);
            document.open();
            document.add(new Paragraph("Challenge Report"));
            document.add(new Paragraph("-----------------"));

            for (ChallengeAttempt attempt : attempts) {
                document.add(new Paragraph("Challenge No: " + attempt.getChallenge_no()));
                document.add(new Paragraph("Participant ID: " + attempt.getParticipant_id()));
                document.add(new Paragraph("Start Time: " + attempt.getStart_time()));
                document.add(new Paragraph("Score: " + attempt.getScore()));
                document.add(new Paragraph("-----------------"));
            }

            document.close();
        } catch (DocumentException e) {
            e.printStackTrace();
        }

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication("jimisaac8082@gmail.com", "wnza cduy pqch ydyw");
            }
        });

        try {
            MimeMessage message = new MimeMessage(session);
            message.setFrom(new InternetAddress(sender));
            message.addRecipient(Message.RecipientType.TO, new InternetAddress(recipient));
            message.setSubject("Challenge Report");

            MimeBodyPart messageBodyPart = new MimeBodyPart();
            messageBodyPart.setText("Please find the attached challenge report.");

            MimeBodyPart attachmentBodyPart = new MimeBodyPart();
            ByteArrayInputStream pdfInputStream = new ByteArrayInputStream(pdfOutputStream.toByteArray());
            attachmentBodyPart.attachFile("challenge-report.pdf");
            attachmentBodyPart.setDataHandler(new DataHandler(new ByteArrayDataSource(pdfInputStream, "application/pdf")));
            attachmentBodyPart.setFileName("challenge-report.pdf");

            MimeMultipart multipart = new MimeMultipart();
            multipart.addBodyPart(messageBodyPart);
            multipart.addBodyPart(attachmentBodyPart);

            message.setContent(multipart);

            Transport.send(message);
            System.out.println("Report sent successfully...");
        } catch (MessagingException | IOException e) {
            System.out.println(e.getMessage());
        }
    }
}
