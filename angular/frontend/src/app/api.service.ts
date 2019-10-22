import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {AuthService} from "./user/auth.service";
import {Observable} from "rxjs";
import {LoadingService} from "./loading.service";
import {map} from "rxjs/operators";

const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type':  'application/json'
  })
};

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  api_url: string = 'http://localhost/api';
  authHash = null;
  constructor(private http: HttpClient) { }

  get(url: string): Observable<any> {
    this.updateHeaders();
    return this.http.get(this.api_url + url, httpOptions);
  }
  post(url: string, data): Observable<any> {
    this.updateHeaders();
    httpOptions.headers = httpOptions.headers.set('Content-Type', 'application/x-www-form-urlencoded');
    return this.http.post(this.api_url + url, data, httpOptions);
  }


  updateHeaders() {
    if (!httpOptions.headers.has('Authorization') && this.authHash !== null) {
      httpOptions.headers = httpOptions.headers.set('Authorization', this.authHash);
    }
  }
}
