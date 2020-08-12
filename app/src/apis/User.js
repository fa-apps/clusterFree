import Api from "./Api";

export default {

    visit(form) {
        
        return Api().post("/visit",form)
    },
    register(form) {
        
        return Api().post("/register",form)
    },

    login(form) {
        
        return Api().post("/login",form)
    }, 

    logout() {

        return Api().post("/logout");
    },

    auth() {
        
        return Api().get("/user");
    }
}