import Api from "./Api";

export default {

    report(form) {
        
        return Api().post("/report", form);
    }
}