import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { UserRoutingModule } from "./user-routing.module";
import { UserComponent } from './user/user.component';
import { ReactiveFormsModule } from '@angular/forms';
import { LogoutComponent } from './logout/logout.component';
import { SignupComponent } from './signup/signup.component';


@NgModule({
  declarations: [LoginComponent, DashboardComponent, UserComponent, LogoutComponent, SignupComponent],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    UserRoutingModule
  ]
})
export class UserModule { }
