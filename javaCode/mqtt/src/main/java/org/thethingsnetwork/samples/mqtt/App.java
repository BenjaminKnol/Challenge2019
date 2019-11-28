/*package org.thethingsnetwork.samples.mqtt;

import org.json.JSONObject;
import org.thethingsnetwork.data.common.Connection;
import org.thethingsnetwork.data.common.messages.DataMessage;
import org.thethingsnetwork.data.common.messages.UplinkMessage;
import org.thethingsnetwork.data.mqtt.Client;

public class App {
    public static void main(String[] args) throws Exception {

        String region = "eu";
        String appId = "boaskaken1";
        String accessKey = "ttn-account-v2.ZjdRbI-Vb64PQlXljMXWKglvwr_NQbnj9IriE-7ZMA4";

        Client client = new Client(region, appId, accessKey);



        client.onMessage((String devId, DataMessage data) -> System.out.println("Message: " + devId + " " + ((UplinkMessage) data).getCounter()));

        client.onError((Throwable _error) -> System.err.println("error: " + _error.getMessage()));

        client.onConnected((Connection _client) -> System.out.println("connected !"));

        client.start();
    }
}*/

package org.thethingsnetwork.samples.mqtt;

import org.thethingsnetwork.data.common.Connection;
import org.thethingsnetwork.data.common.messages.ActivationMessage;
import org.thethingsnetwork.data.common.messages.DataMessage;
import org.thethingsnetwork.data.common.messages.DownlinkMessage;
import org.thethingsnetwork.data.common.messages.RawMessage;
import org.thethingsnetwork.data.common.messages.UplinkMessage;
import org.thethingsnetwork.data.mqtt.Client;

/**
 *
 * @author Romain Cambier
 */
public class App {

    public static void main(String[] args) throws Exception {

        String region = "eu";
        String appId = "boaskaken1";
        String accessKey = "ttn-account-v2.ZjdRbI-Vb64PQlXljMXWKglvwr_NQbnj9IriE-7ZMA4";

        Client client = new Client(region, appId, accessKey);

        class Response {

            private boolean led;

            public Response(boolean _led) {
                led = _led;
            }
        }

        client.onMessage(null, "led", (String _devId, DataMessage _data) -> {
            try {
                RawMessage message = (RawMessage) _data;
                // Toggle the LED
                DownlinkMessage response = new DownlinkMessage(0, new Response(!message.asBoolean()));

                /**
                 * If you don't have an encoder payload function:
                 * client.send(_devId, new Response(0, message.asBoolean() ? new byte[]{0x00} : new byte[]{0x01}));
                 */
                System.out.println("Sending: " + response);
                client.send(_devId, response);
            } catch (Exception ex) {
                System.out.println("Response failed: " + ex.getMessage());
            }
        });

        client.onMessage((String devId, DataMessage data) -> System.out.println("Message: " + devId + " " + ((UplinkMessage) data).getCounter()));

        client.onActivation((String _devId, ActivationMessage _data) -> System.out.println("Activation: " + _devId + ", data: " + _data.getDevAddr()));

        client.onError((Throwable _error) -> System.err.println("error: " + _error.getMessage()));

        client.onConnected((Connection _client) -> System.out.println("connected !"));

        client.start();
    }

}

