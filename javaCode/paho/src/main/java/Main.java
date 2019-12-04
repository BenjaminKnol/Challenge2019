//https://www.hivemq.com/blog/mqtt-client-library-encyclopedia-eclipse-paho-java/
//https://www.eclipse.org/paho/clients/java/

import org.eclipse.paho.client.mqttv3.MqttConnectOptions;

class Main {

    public static void main(String[] args0) {

        boolean TLS = false;
        String protocol = "tcp";
        String regon = "eu";
        String host = regon + ".thethings.network";

        MqttConnectOptions MQTToptions = new MqttConnectOptions();
        MQTToptions.setUserName("boaskaken1");
        MQTToptions.setPassword("ttn-account-v2.ZjdRbI-Vb64PQlXljMXWKglvwr_NQbnj9IriE-7ZMA4".toCharArray());


        try {
            MQTT mqtt = new MQTT(TLS, protocol, host, MQTToptions);
        } catch (Exception e) {
            System.err.println("oeeps: " + e.getMessage());


        }

    }
}