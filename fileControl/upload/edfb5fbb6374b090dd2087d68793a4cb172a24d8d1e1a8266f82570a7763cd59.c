#include <stdio.h>
#include <stdlib.h>

unsigned long long twoFuckTen(unsigned long long two)
{
    unsigned long long res = 0;
    char c[100] = {};
    int i = 0;
    for( ;two > 0 ; i ++)
    {
        if(two % 2 == 1){
            c[i] = 1;
        }
        else {
            c[i] = 0;
        }
        two >>= 1;
    }
    for(i -= 1; i >= 0; i --)
    {
        res *= 10;
        res += c[i];
    }
    return res;
}
int main ()
{
    int n;
    while(scanf("%d",&n) != EOF)
    {
        if(n == 0){
            return 0;
        }
        unsigned long long res = 1;
        while(twoFuckTen(res)%n != 0){
            res += 1;
        }
        printf("%d\n",twoFuckTen(res));
    }
}