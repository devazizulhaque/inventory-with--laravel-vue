import Token from './Token'
import AppStorage from './AppStorage'

class Useer {
    responseAfterLogin(res) {
        const access_token = res.data.access_token;
        const user = res.data.user;
        if (Token.isValid(access_token)) {
            const userJSON = JSON.stringify(user);
            AppStorage.store(userJSON, access_token);
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    logout() {
        AppStorage.clear();
    }

    name() {
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id() {
        if (this.loggedIn()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(id) {
        return this.id() == id;
    }

    admin() {
        return this.id() == 1;
    }
}

export default Useer = new Useer();