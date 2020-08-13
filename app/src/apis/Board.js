import Api from "./Api";

export default {

    vlp() {
        
        return Api().get("/vlp");
    }
}