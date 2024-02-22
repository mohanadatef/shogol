var firebaseConfig = {
  apiKey: "{{getValueSetting('firebase_api_key','')}}",
  authDomain: "{{getValueSetting('firebase_auth_domain','')}}",
  databaseURL: "{{getValueSetting('firebase_database_url','')}}",
  projectId: "{{getValueSetting('firebase_project_id','')}}",
  storageBucket: "{{getValueSetting('firebase_storage_bucket','')}}",
  messagingSenderId: "{{getValueSetting('firebase_messaging_sender_id','')}}",
  appId: "{{getValueSetting('firebase_app_id')}}",
  measurementId: "{{getValueSetting('firebase_measurement_id','')}}"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
