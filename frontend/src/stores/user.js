// import { defineStore } from 'pinia'

// export const useUserStore = defineStore('user', {
//   state: () => {
//     return { 
//         user: {},
//         token:null 
//     }
//   },
//   actions: {
//     login(data_user,token){
        
//         this.user=data_user
//         this.token=token
//         console.log("PINIA",this..user)
//     },
//     logout(){}
//   }
// })
import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
  const user = ref(null)
  const token = ref("")
  function login(user_data,data_token) {
    console.log("USER Is",user_data)
    user.value=user_data;
    token.value=data_token;
  }
  function logout() {
    user.value=null;
    token.value="";
  }

  return { user,token,login,logout }
})
