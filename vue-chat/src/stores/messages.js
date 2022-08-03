import { defineStore } from "pinia";
import ky from "ky";

export const useMessageStore = defineStore("messages", {
  state: () => ({ messages: [] }),

  actions: {
    async getMessage(id) {
      const access_token = localStorage.getItem("access_token");

      const { data } = await ky
        .get(`${import.meta.env.VITE_API_URL}/messages/user/${id}`, {
          headers: {
            Authorization: `Bearer ${access_token}`,
          },
        })
        .json();
      this.messages = data;
    },
  },
});
