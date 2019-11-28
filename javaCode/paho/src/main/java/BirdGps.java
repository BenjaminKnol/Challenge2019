import java.time.LocalDateTime;

public class BirdGps {

    private LocalDateTime date;
    private String trackerID;
    private double gpsLat;
    private double gpsLog;


    public BirdGps(LocalDateTime date, String trackerID, double gpsLat, double gpsLog) {
        this.date = date;
        this.trackerID = trackerID;
        this.gpsLog = gpsLog;
        this.gpsLat = gpsLat;
    }

    public void setDate(LocalDateTime date) {
        this.date = date;
    }

    public LocalDateTime getDate() {
        return date;
    }

    public void setTrackerID(String trackerID) {
        this.trackerID = trackerID;
    }

    public String getTrackerID() {
        return trackerID;
    }

    public void setGpsLat(long gpsLat) {
        this.gpsLat = gpsLat;
    }

    public double getGpsLat() {
        return gpsLat;
    }

    public void setGpsLong(long gpsLong) {
        this.gpsLog = gpsLong;
    }

    public double getGpsLong() {
        return gpsLog;
    }

    public void print() {
        System.out.printf("id: %s, lang: %s, long: %s, time: %s", trackerID, gpsLat, gpsLog, date.toString());
    }

    public String toString() {
        return "id: " + trackerID + ", lat: " + gpsLat + ", long: " + gpsLog + ", time: " + date.toString();
    }
}
