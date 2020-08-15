import Api from "./Api";

export default {

    vlp() {
        
        return Api().get("/vlp");
    },
    rlp() {
        
        return Api().get("/rlp");
    },
    rsl() {
        
        return Api().get("/rsl");
    }
}