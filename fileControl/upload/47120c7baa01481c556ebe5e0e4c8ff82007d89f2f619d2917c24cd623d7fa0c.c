#include <stdio.h>
#include <stdlib.h>
typedef long long ll;
ll m(ll a,ll b,ll n){
  ll t,y;
  t=1; y=a;
  while (b!=0){
    if (b&1==1) t=t*y%n;
    y=y*y%n; b=b>>1;
  }
  return t;
}

long long gcd2 (long long a, long long b)    
{    
    return b == 0 ? a : gcd2(b,a%b);
}
int main()
{
    for (ll i = 3811415 ; i > 0;i ++)
    {
        if(gcd2(i,403522560) == 1)
        {
            //putchar('q');
            if(m(1617522,i,14411521) == 3811414){
                printf("%lld",i);
            }
        }
    }
}
