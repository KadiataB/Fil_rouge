import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Auth } from '../interfaces/auth';
import { Classe } from '../interfaces/classe';
import { Cours } from '../interfaces/cours';
import { CoursClasse } from '../interfaces/cours-classe';
import { Demande } from '../interfaces/demande';
import { Import } from '../interfaces/import';
import { Kb } from '../interfaces/kb';
import { ListeC, ListeS } from '../interfaces/liste';
import { Module } from '../interfaces/module';
import { ModuleProfesseur } from '../interfaces/module-professeur';
import { Response } from '../interfaces/response';
import { Salle } from '../interfaces/salle';
import { Semestre } from '../interfaces/semestre';
import { Session } from '../interfaces/session';

@Injectable({
  providedIn: 'root'
})
export class CoursService {

  constructor(private http:HttpClient) { }

  private apiUrl = 'http://127.0.0.1:8000/api/';


  getSemestre(): Observable<Response<Semestre[]>> {
    return this.http.get<Response<Semestre[]>>(this.apiUrl + "semestres");
  }

  getClasse(): Observable<Response<Classe[]>> {
    return this.http.get<Response<Classe[]>>(this.apiUrl + "classes");
  }

  getModule(): Observable<Response<Module[]>> {
    return this.http.get<Response<Module[]>>(this.apiUrl  + "modules");
  }

  getProfesseur(id:number): Observable<Response<ModuleProfesseur[]>> {
    return this.http.get<Response<ModuleProfesseur[]>>(`${this.apiUrl}modules/${id}/profs`);
  }


  insertCours(data:Cours):Observable<Cours> {
    return this.http.post<Cours>(this.apiUrl + "cours",data)
  }
  session(data:Session):Observable<Session> {
    return this.http.post<Session>(this.apiUrl + "sessions",data)
  }

  getSalles():Observable<Response<Salle[]>> {
    return this.http.get<Response<Salle[]>>(this.apiUrl + "salles");
  }


  getDemandes():Observable<Response<Demande[]>> {
    return this.http.get<Response<Demande[]>>(this.apiUrl + "demandes");
  }

  getCours():Observable<Response<ListeC[]>> {
    return this.http.get<Response<ListeC[]>>(this.apiUrl + "cours")
  }

  allClasses(id:number) :Observable<Response<CoursClasse[]>>{
    return this.http.get<Response<CoursClasse[]>>(`${this.apiUrl}cours/${id}/classes`)
  }

  coursClasses(idCours:number,idClasse:number) :Observable<Response<Kb[]>>{
    return this.http.get<Response<Kb[]>>(`${this.apiUrl}cours/${idCours}/classes/${idClasse}/coursclasses`)
  }

  allSessions():Observable<Response<ListeS[]>> {
    return this.http.get<Response<ListeS[]>>(this.apiUrl + "sessions")
  }
  import(data:any):Observable<any> {
    return this.http.post<any>(this.apiUrl + "users",data)
  }

  connexion(data:object): Observable<Auth> {
    return this.http.post<Auth>(this.apiUrl + "login", data)
  }
  logout(): Observable<Auth> {
    return this.http.post<Auth>(this.apiUrl + "logout",'')
  }

  get token() {
    return localStorage.getItem('token')
  }

  public isToken() {
   return  localStorage.getItem('token')!=null
  }

  demande(data:any):Observable<any> {
    return this.http.post<any>(`${this.apiUrl}sessions/demandes`,data)
  }

  coursProf(id:number):Observable<any> {

    return this.http.get<any>(`${this.apiUrl}users/${id}/cours`)
  }
  sessionsProf(id:number):Observable<any> {

    return this.http.get<any>(`${this.apiUrl}users/${id}/sessions`)
  }

  findByModule(module:string):Observable<any> {
    return this.http.get<any>(`${this.apiUrl}cours/module/${module}`)
  }

}

