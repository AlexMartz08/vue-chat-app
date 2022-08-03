import { defineStore } from "pinia";
import ky from "ky";
import router from "../router";

export const useAuthStore = defineStore("user", {
  state: () => ({ user: {}, isLogged: false }),
  actions: {
    async getAuthUser() {
      try {
        const access_token = localStorage.getItem("access_token");

        const resp = await ky
          .get(`${import.meta.env.VITE_API_URL}/user`, {
            headers: {
              Authorization: `Bearer ${access_token}`,
            },
          })
          .json();

        this.user = resp;
        this.isLogged = true;
        // return resp;
      } catch (error) {
        this.isLogged = false;
        localStorage.removeItem("access_token");
        router.push("/login");
      }
    },
    // setUser(user) {
    //   this.user = user;
    // },
  },
});
