import axios from "axios";
import router from "@/router"
import { useUserStore } from '@/stores/user';
const request = axios.create({
    baseURL: 'http://localhost:8000/api',
  })

  
  request.interceptors.request.use((config)=>{
    const store = useUserStore()
    let tokenAuth='Bearer '+store.token
    config.headers["Authorization"]=tokenAuth
    return config
})

request.interceptors.response.use(response=>{
    console.log("sukses dari plugins",response.data);
    return Promise.resolve(response.data);
},async error=>{
    console.log("error dari plugins",error);
    if(error.response.status==401){
        const store = useUserStore()
        store.logout();
    //     localStorage.removeItem('user')
    // localStorage.removeItem('token')
        router.push("/login"); 
    }else{
        return Promise.reject(error.response)
    }
})


export default request