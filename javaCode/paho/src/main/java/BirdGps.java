import java.util.Date;

public class BirdGps {

    private Date date;
    private String trackerID;
    private double gpsLat;
    private double gpsLog;


    public BirdGps(Date date, String trackerID, double gpsLat, double gpsLog) {
        this.date = date;
        this.trackerID = trackerID;
        this.gpsLat = gpsLat;
        this.gpsLog = gpsLog;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public Date getDate() {
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
