function SALIR() 
{
    if(navigator.app)
    {
            navigator.app.exitApp();
    }else if(navigator.device)
    {
            navigator.device.exitApp();
    }else	{navigator.device.exitApp();}
}


