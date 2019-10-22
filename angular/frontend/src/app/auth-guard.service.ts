import { Injectable } from '@angular/core';
import {CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, Router} from '@angular/router';
import {AuthService} from "./user/auth.service";
@Injectable({
  providedIn: 'root'
})
export class AuthGuardService implements CanActivate {
  constructor(private authService: AuthService, private router: Router) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): boolean {
    let url: string = state.url;
    let permission: string = next.data.permission?next.data.permission:null;
    return this.checkLogin(url, permission);
  }

  checkLogin(url: string, permission?: string): boolean {
    if (this.authService.isLoggedIn() && (!permission || this.authService.can(permission))) {
      return true;
    }

    // Store the attempted URL for redirecting
    this.authService.redirectUrl = url;

    // Navigate to the login page with extras
    this.router.navigate(['/user/login']);
    return false;
  }
}
