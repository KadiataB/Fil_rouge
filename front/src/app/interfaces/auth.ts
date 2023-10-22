export interface Auth {
  email:string;
  password:string;
  token:string;
  user:User;
}

export interface User {
  id:number;
  name:string;
  email:string;
  role:string
}
