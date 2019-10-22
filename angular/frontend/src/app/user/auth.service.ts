import { Injectable } from '@angular/core';
import {ApiService} from "../api.service";
import {Router} from "@angular/router";
import {LoadingService} from "../loading.service";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  redirectUrl: string;
  permissions: string[];
  constructor(private api: ApiService,private router: Router, private loading: LoadingService) {
    this.api.authHash = sessionStorage.getItem('userHash');
  }
  login(data, callable): void {
    this.loading.show();
    this.api.post('/login', data)
      .subscribe({
        next: data => {
          this.api.authHash = data.hash;
          this.permissions = data.permissions;
          sessionStorage.setItem('userHash', data.hash);
          if (callable) {
            callable.call(this.api, data.hash);
          } else if (this.redirectUrl) {
            this.router.navigate([this.redirectUrl]);
            this.redirectUrl = null;
          }
        },
        error: () => {
          this.router.navigate(['/login-page-error']);
        },
        complete: () => this.loading.hide()
      });
  }

  logout(): void {
    this.api.authHash = null;
    sessionStorage.setItem('userHash', null);
  }

  isLoggedIn(): boolean {
    return this.api.authHash !== null;
  }

  can(permission: string): boolean {
    return this.permissions.indexOf(permission) !== -1;
  }
}
