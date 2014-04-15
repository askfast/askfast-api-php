<?php
class OAuthClient {

    protected $tokenUrl = null;
    protected $accountId = null;
    protected $refreshToken = null;

    public function _construct($tokenUrl, $accountId, $refreshToken) {
        $this->tokenUrl = $tokenUrl;
        $this->accountId = $accountId;
        $this->refreshToken = $refreshToken;
    }

    public function getAccessToken() {

        $fields = "clientId=".$this->accountId;
        $fields .= "&clientSecret=nothing";
        $fields .= "&refreshToken=".$this->refreshToken;
        $fields .= "&grant_type=resfresh_token";

        $ch = curl_init(tokenUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($ch);
        curl_close($ch);

        return $resp;
    }
}
?>
