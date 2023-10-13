import { Time } from "@angular/common";

export interface Session {
  hd:Time,
  hf:Time,
  duree:Time,
  cours_classe_id:number,
  mode:string,
  classe_id:number
}
