module Sailthru_Social
  class Gigya < Sailthru::SailthruClient

    def initialize(api_key, secret, api_uri=nil, proxy_host=nil, proxy_port=nil)
      fields={"keys"=>1}
      super(api_key, secret, api_uri, proxy_host, proxy_port)
    end

    def social_login (social_data, request_data)
      JSON.parse(social_data.to_json)
      use_email_as_key=false;
      data={}
      provider=social_data["provider"]

      if social_data["user"] && social_data["user"]["email"]
        data["key"]= "email"
        data["id"]=social_data["user"]["email"]
      else
        data["key"]=case provider
        when "twitter"
          "twitter"
        when "facebook"
          "facebook"
        else
          "extid"
        end
      end
      data["options"] = {
          "login"=>{
          "user_agent" => request_data["user_agent"],
          "key"=>data["key"],
          "ip"=> request_data["remote_ip"],
          "site"=> request_data["remote_ip"]
        },
        "fields"=> {"activity"=>1}
      }

      data["vars"]={}
      not_wanted=["UID","UIDSig","UIDSignature"]
      social_data["user"].map do |key, value|
        data["vars"][provider+"_"+key]=value
        # if not_wanted.includes? key
        #   data["vars"][provider+"_"+key]=value
        # end
      end
      sync=sync_data(data)
    end

    def sync_data (data)
      begin
        return self.api_post("user", data)
      rescue => ex
        puts ex
        return false
      end
    end
  end
end
