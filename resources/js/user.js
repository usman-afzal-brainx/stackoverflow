const axios = require("axios");

export default async function getUser() {
    const { data } = await axios.get("/api/user", {
        headers: {
            Authorization:
                "Bearer " + window.localStorage.getItem("access_token"),
            Accept: "application/json"
        }
    });
    return data;
}
