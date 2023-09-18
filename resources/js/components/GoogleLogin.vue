<template>

  <GoogleSignInButton @success="handleLoginSuccess" @error="handleLoginError"></GoogleSignInButton>

</template>

<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import {
  GoogleSignInButton, decodeCredential,
  type CredentialResponse,
} from "vue3-google-signin";



const handleLoginSuccess = async (response) => {
  const userData = decodeCredential(response.credential)
  // console.log("Access Token", userData);
  let pro = {
    "first_name": userData.given_name,
    "last_name": userData.family_name,
    "email": userData.email,
    "provider_id": userData.id,
    "provider_name": 'Google'
  }

  router.post(route('socialLogin'),pro);

};

// handle an error event
const handleLoginError = () => {
  console.error("Login failed");
};



//    
// -----------------------------------------------------------------------
//   ==================================================================     
//       Google Account setup procedure:
//  ==================================================================
//   Step 1: Goto https://console.cloud.google.com/ and Select a project if any else create project
//   Step 2: select created project.
//   Step 3: goto "OAuth Content screen"
//   Step 4: choose External and click create button
//   Step 5: Fill only mandatory fill and continue  
//   Step 6: Goto "Credentials" and click on "create credentials"
//   Step 7: choose "OAuth Client ID"
//   Step 8: Choose application type(web application )(as per your application).
//  Step 9: Add Authorised JavaScript origins and Authorised redirect URIs and create.
//           for example: https://techdisciples.dedicateddevelopers.us
//            Note: Don't use '/'  after base url like https://techdisciples.dedicateddevelopers.us/ 
//                    and for localhost use both http://localhost and http://localhost:<port number>
//                    like (http://localhost:8000). Must change in "APP_URL" in .env file.
//   Step 10: Copy client id and Client secret and paste it in any text file. Don't lost this.
//   Step 11: Go to "Enabled api and services" and  click on "+ enable api and serveces" button
//   Step 12: Search for "Google+ API" and "Google analytics API" and enable both these.
//   Step 13: that's it. Now use client Id in your project. 
//   337839940049-vttb62h20o9ngsfigvriolp61q860c0t.apps.googleusercontent.com
//   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
//   -----------------------------------------------------------------------
//  /
</script>



